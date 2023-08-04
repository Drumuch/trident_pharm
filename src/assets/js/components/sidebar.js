export default class Sidebar {
  sidebarToggleRef;
  sidebarContentRef;
  constructor() {
    this.sidebarToggleRef = document.querySelector('[data-sidebar-toggle]');
    this.sidebarContentRef = document.querySelector('[data-sidebar-content]');
    if (!this.sidebarToggleRef || !this.sidebarContentRef) return;
    this.init();
  }

  init() {
    this.sidebarToggleRef.addEventListener('click', () => {
      this.sidebarContentRef.classList.toggle('is-active');
      this.sidebarToggleRef.classList.toggle('is-active');
      if (this.sidebarContentRef.classList.contains('is-active')) {
        this.sidebarContentRef.style.maxHeight = this.sidebarContentRef.scrollHeight + 'px';
      } else {
        this.sidebarContentRef.style.maxHeight = null;
      }
    });
  }
}
