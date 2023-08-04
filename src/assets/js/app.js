import './lib/_bootstrap.js';

import Header from "./components/header";
import Footer from "./components/footer";
import SingleProduct from "./components/single-product";
import Sidebar from "./components/sidebar";

class App {
  constructor() {
    this.init();
  }

  init() {
    new Header();
    new Footer();
    new SingleProduct();
    new Sidebar();
  }
}

new App();
