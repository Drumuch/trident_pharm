export default class Footer {
  footerDropdownToggleRef;
  constructor() {
    this.footerDropdownToggleRef = [...document.querySelectorAll('[data-dropdown-toggle]')] ?? [];
    this.footerDropdownToggleRef.forEach((item) => {
      item.addEventListener('click', () => {
        item.nextElementSibling.classList.toggle('open');
        item.classList.toggle('open');
      });
    });
  }
}
