const path = require('path');
const named = require('vinyl-named');
const dateFormat = require('dateformat');
const fs = require('fs');
const yargs = require('yargs');
const rimraf = require('rimraf');
const yaml = require('js-yaml');

// Load gulp plugins and passing them semantic names
const gulp = require('gulp'); // Gulp of-course.

// CSS related plugins.
const sass = require('gulp-sass')(require('sass')); // Gulp plugin for Sass compilation.
const cleanCss = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer'); // Autoprefixing magic.
const cache = require('gulp-cached');
const purgecss = require('gulp-purgecss');

// Image related plugins.
// const imageMin = require('gulp-imagemin'); // Minify PNG, JPEG, GIF and SVG images with imagemin.

// Utility related plugins.
const sourcemaps = require('gulp-sourcemaps'); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css).
const gulpIf = require('gulp-if');
const gulpZip = require('gulp-zip');
const browserSync = require('browser-sync'); // Reloads browser and injects CSS. Time-saving synchronized browser testing.
const log = require('fancy-log');
const colors = require('ansi-colors');
const glob = require('glob');
const webpack2 = require('webpack');
const webpackStream = require('webpack-stream');

// Check for --production flag
const PRODUCTION = !!(yargs.argv.production);

// Load settings from settings.yml
const { BROWSERSYNC, PATHS } = loadConfig();

// Check if file exists synchronously
function checkFileExists(filepath) {
  let flag = true;
  try {
    fs.accessSync(filepath, fs.F_OK);
  } catch(e) {
    flag = false;
  }
  return flag;
}

// Load default or custom YML config file
function loadConfig() {
  log('Loading config file...');

  if (checkFileExists('config.yml')) {
    // config.yml exists, load it
    log(colors.bold(colors.cyan('config.yml')), 'exists, loading', colors.bold(colors.cyan('config.yml')));
    let ymlFile = fs.readFileSync('config.yml', 'utf8');
    return yaml.load(ymlFile);

  } else if(checkFileExists('config-default.yml')) {
    // config-default.yml exists, load it
    log(colors.bold(colors.cyan('config.yml')), 'does not exist, loading', colors.bold(colors.cyan('config-default.yml')));
    let ymlFile = fs.readFileSync('config-default.yml', 'utf8');
    return yaml.load(ymlFile);

  } else {
    // Exit if config.yml & config-default.yml do not exist
    log('Exiting process, no config file exists.');
    log('Error Code:', err.code);
    process.exit(1);
  }
}

// Delete the "dist" folder
// This happens every time a build starts
const clean = (done) => {
  rimraf(PATHS.dist, done);
}

// Copy files out of the assets folder
// This task skips over the "images", "js", and "scss" folders, which are parsed separately
const copy = () => {
  return gulp.src(PATHS.assets)
    .pipe(gulp.dest(PATHS.dist + '/assets'));
}

// Compile Sass into CSS
// In production, the CSS is compressed
const styles = () => {
  return gulp.src(PATHS.entriestyles)
    .pipe(sourcemaps.init())
    .pipe(sass({
      includePaths: PATHS.sass
    })
      .on('error', sass.logError))
    .pipe(cache())
    .pipe(autoprefixer())
    .pipe(gulpIf(PRODUCTION, cleanCss({ compatibility: 'ie9' })))
    .pipe(gulpIf(!PRODUCTION, sourcemaps.write()))
    .pipe(gulp.dest(PATHS.dist + '/assets/css'))
    .pipe(browserSync.reload({ stream: true }));
}

const purgeCSS = () => {
  return gulp.src(PATHS.dist + '/assets/css/app.css')
    .on('error', (err) => {
      log('[webpack:error]', err.toString({
        colors: true,
      }));
    })

    .pipe(purgecss({
      content: [
        './**/*.php',
        '**/*.twig',
        './src/assets/js/*/**.js'
      ],
      skippedContentGlobs: ['./node_modules/**'],
      safelist: {
        deep: [/offcanvas$/],
      }
    }))
    .pipe(gulp.dest(PATHS.dist + '/assets/css'));
}

const mainEntries = Object.assign(
  {},
  ...glob.sync('src/assets/js/*.js').map((file) => {
    if (file.length > 0) {
      let arr = file.split('/');
      const fileName = arr[arr.length - 1];
      return {[fileName]: `./${file}`};
    }
  })
);


const blockStyleEntries = [
  ...glob.sync('./inc/Gutenberg/Blocks/*/assets/style.scss').map((block) => {
    if (block.length > 0) {
      return `./${block}`;
    }
  })
];

const blockScriptEntries = Object.assign(
  {},
  ...glob.sync('./inc/Gutenberg/Blocks/*/assets/app.js').map((block) => {
    if (block.length > 0) {
      let arr = block.split('/');
      const blockName = arr[4];
      return {[blockName]: `${block}`};
    }
  })
);

const gutenbergStyles = () => {
  return gulp.src(blockStyleEntries)
    .pipe(sourcemaps.init())
    .pipe(sass({
      includePaths: PATHS.sass
    })
      .on('error', sass.logError))
    .pipe(cache())
    // .pipe(gulpIf(PRODUCTION, cleanCss({ compatibility: 'ie9' })))
    .pipe(gulpIf(!PRODUCTION, sourcemaps.write()))
    .pipe(gulp.dest((file) => {
      return path.resolve(file.base, '..', 'dist');
    }))
    .pipe(browserSync.reload({ stream: true }));
}

// Combine JavaScript into one file
// In production, the file is minified
const webpack = {
  config: {
    module: {
      rules: [
        {
          test: /\.(js|jsx)$/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: [ "@babel/preset-env", "@babel/preset-react" ],
              compact: false
            }
          },
          exclude: /node_modules(?![\\\/]foundation-sites)/,
        },
      ],
    },
    plugins: [
      new webpack2.optimize.LimitChunkCountPlugin({
        maxChunks: 1,
      })
    ],
    mode: PRODUCTION ? 'production' : 'development',
    externals: {
      jquery: 'jQuery',
    },
    resolve: {
      extensions: ['.js', '.jsx'],
    }
  },

  changeHandler(err, stats) {
    log('[webpack]', stats.toString({
      colors: true,
    }));

    browserSync.reload();
  },

  build() {
    let config = Object.assign(webpack.config, {
      entry: mainEntries,
      output: {
        filename: "[name]",
      },
    });
    return gulp.src(Object.values(mainEntries))
      .pipe(named())
      .pipe(webpackStream(config, webpack2))
      .pipe(gulp.dest(PATHS.dist + '/assets/js'));
  },

  buildBlocks() {
    let configBlocks = Object.assign(webpack.config, {
      entry: blockScriptEntries,
      output: {
        filename: "./inc/Gutenberg/Blocks/[name]/dist/app.js",
      },
    });

    return gulp.src(Object.values(blockScriptEntries), {base : '.'})
      .pipe(named())
      .pipe(webpackStream(configBlocks, webpack2))
      .pipe(gulp.dest('./'));
  },

  watch() {
    const watchConfig = Object.assign(webpack.config, {
      watch: true,
      devtool: 'inline-source-map',
      entry: mainEntries,
      output: {
        filename: "[name]",
      },
    });

    return gulp.src(Object.values(mainEntries))
      .pipe(named())
      .pipe(webpackStream(watchConfig, webpack2, webpack.changeHandler)
        .on('error', (err) => {
          log('[webpack:error]', err.toString({
            colors: true,
          }));
        }),
      )
      .pipe(gulp.dest(PATHS.dist + '/assets/js'));
  },

  watchBlocks() {
    const watchConfig = Object.assign(webpack.config, {
      watch: true,
      devtool: 'inline-source-map',
      entry: blockScriptEntries,
      output: {
        filename: "./inc/Gutenberg/Blocks/[name]/dist/app.js",
      },
    });

    return gulp.src(Object.values(blockScriptEntries), {base: '.'})
      .pipe(named())
      .pipe(webpackStream(watchConfig, webpack2, webpack.changeHandler)
        .on('error', (err) => {
          log('[webpack:error]', err.toString({
            colors: true,
          }));
        }),
      )
      .pipe(gulp.dest('./'));
  },
};

gulp.task('webpack:build', webpack.build);
gulp.task('webpack:build-blocks', webpack.buildBlocks);
gulp.task('webpack:watch', webpack.watch);
gulp.task('webpack:watch-blocks', webpack.watchBlocks);

// Copy images to the "dist" folder
// In production, the images are compressed
const images = () => {
  return gulp.src('src/assets/images/**/*')
    // .pipe(gulpIf(PRODUCTION, imageMin([
    //   imageMin.mozjpeg({progressive: true}),
    //   imageMin.optipng({
    //     optimizationLevel: 5,
    //   }),
    //   imageMin.svgo({
    //     plugins: [
    //       {cleanupAttrs: true},
    //       {removeComments: true},
    //     ]
    //   })
    // ])))
    .pipe(gulp.dest(PATHS.dist + '/assets/images'));

}// Copy fonts to the "dist" folder
const fonts = () => {
  return gulp.src('src/assets/fonts/**/*')
    .pipe(gulp.dest(PATHS.dist + '/assets/fonts'));
}

// Start BrowserSync to preview the site in
const server = (done) => {
  browserSync.init({
    proxy: BROWSERSYNC.url,
    ui: {
      port: 8080
    },
  });
  done();
}

// Reload the browser with BrowserSync
const reload = (done) => {
  browserSync.reload();
  done();
}

// Watch for changes to static assets, pages, Sass, and JavaScript
const watch = () => {
  gulp.watch(PATHS.assets, copy);
  gulp.watch('src/assets/scss/**/*', styles)
    .on('change', path => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', path => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'));
  gulp.watch('./inc/Gutenberg/Blocks/*/assets/style.scss', gutenbergStyles)
    .on('change', path => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', path => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'));
  gulp.watch('**/*.php', reload)
    .on('change', path => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', path => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'));
  gulp.watch('**/*.twig', reload)
    .on('change', path => log('File ' + colors.bold(colors.magenta(path)) + ' changed.'))
    .on('unlink', path => log('File ' + colors.bold(colors.magenta(path)) + ' was removed.'));
  gulp.watch('src/assets/images/**/*', gulp.series(images, reload));
  gulp.watch('src/assets/fonts/**/*', gulp.series(fonts, reload));
}

// Create a .zip archive of the theme
const archive = () => {
  let time = dateFormat(new Date(), "yyyy-mm-dd_HH-MM");
  let pkg = JSON.parse(fs.readFileSync('./package.json'));
  let title = pkg.name + '_' + time + '.zip';

  return gulp.src(PATHS.package)
    .pipe(gulpZip(title))
    .pipe(gulp.dest('packaged'));
}

// Build the "dist" folder by running all of the below tasks
gulp.task('build',
  gulp.series(clean, gulp.parallel(styles, gutenbergStyles, 'webpack:build', 'webpack:build-blocks', images, fonts, copy)));

// Build the site, run the server, and watch for file changes
gulp.task('default',
  gulp.series('build', server, gulp.parallel('webpack:watch', 'webpack:watch-blocks', watch)));

gulp.task('purge:css', purgeCSS);

// Package task
gulp.task('zip',
  gulp.series('build', 'purge:css', archive));
