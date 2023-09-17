export default class Header {
  headerRef;
  burgerMenuRef;
  offcanvasRef;
  prevScroll;
  curScroll;
  direction;
  prevDirection;

  constructor() {
    this.burgerMenuRef = document.querySelector("[data-burger-menu]");
    this.offcanvasRef = document.querySelector("[data-offcanvas]");
    this.headerRef = document.querySelector("[data-header]");
    this.headerBarRef = document.querySelector("[data-header-bar]") ?? null;
    this.prevScroll = window.scrollY || document.documentElement.scrollTop;
    this.curScroll = 0;
    this.direction = 0;
    this.prevDirection = 0;
    this.init();
  }

  init() {
    this.setHeaderHeight();
    this.checkScroll();
    this.onWindowScroll();
    window.addEventListener('resize', this.setHeaderHeight.bind(this));
    this.offcanvasRef.addEventListener('show.bs.offcanvas', () => this.changeBurgerMenuIcon());
    this.offcanvasRef.addEventListener('hide.bs.offcanvas', () => this.changeBurgerMenuIcon());
  }

  setHeaderHeight() {
    this.headerHeight = this.headerRef?.offsetHeight ?? 0;
    this.headerBarHeight = this.headerBarRef?.offsetHeight ?? 0;
    document.documentElement.style.setProperty('--header-height', this.headerHeight + "px");
    document.documentElement.style.setProperty('--header-bar-height', this.headerBarHeight + "px");
  }

  changeBurgerMenuIcon() {
    this.burgerMenuRef.classList.toggle('open');
  }

  checkScroll() {
    /*
    ** Find the direction of scroll
    ** 0 - initial, 1 - up, 2 - down
    */
    this.curScroll = window.scrollY || document.documentElement.scrollTop;
    if (this.curScroll > this.prevScroll) {
      //scrolled up
      this.direction = 2;
    } else if (this.curScroll < this.prevScroll) {
      //scrolled down
      this.direction = 1;
    }

    // let header = document.querySelector("[data-header-nav]");

    if (this.direction !== this.prevDirection) {

      if (this.direction === 2 && this.curScroll > this.headerHeight ) {
        this.headerRef.classList.add('fp-slide-out');
        this.prevDirection = this.direction;
      } else if (this.direction === 1) {
        this.headerRef.classList.remove('fp-slide-out');
        this.prevDirection = this.direction;
      }

    }
    this.prevScroll = this.curScroll;

    if(this.curScroll < this.headerHeight){
      this.headerRef.classList.remove('has-shadow')
    } else {
      this.headerRef.classList.add('has-shadow')
    }
  };

  onWindowScroll() {
    window.addEventListener('scroll', this.checkScroll.bind(this));
  }
}
