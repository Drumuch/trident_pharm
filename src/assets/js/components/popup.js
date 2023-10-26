import Modal from "bootstrap/js/dist/modal";

document.addEventListener('DOMContentLoaded', function () {
  let popUp = document.querySelector('[data-pop-up]');
  let clipboard = document.querySelector('[data-clipboard]');
  if (!popUp) return;
  let timer = popUp.dataset.timer || 5;
  clipboard.addEventListener('click', function () {
    let value = clipboard.dataset.clipboard;
    navigator.clipboard.writeText(value);
  });
  const modal = new Modal(popUp);
  setTimeout(() => {
    modal.show();
  }, timer * 1000);
});
