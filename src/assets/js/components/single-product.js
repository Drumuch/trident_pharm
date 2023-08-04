import Splide from "@splidejs/splide";

export default class SingleProduct {
  singleProductGalerryRef;
  sliderOptions;
  constructor() {
    this.sliderOptions = {
      type: 'fade',
      rewind: true,
      arrows: false,
      pagination: true,
      focus: 'center',
    };

    this.singleProductGalerryRef = document.querySelector('[data-product-gallery]');

    if ( ! this.singleProductGalerryRef ) return;

    new Splide(this.singleProductGalerryRef, this.sliderOptions).mount();
  }
}
