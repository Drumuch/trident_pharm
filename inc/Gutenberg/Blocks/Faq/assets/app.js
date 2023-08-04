
const initializeBlock = function (block) {
  const faqItems = [...block.querySelectorAll('[data-faq-item]')];

  faqItems.forEach((accordion) => {
    const toggle = accordion.querySelector('[data-faq-toggle]');
    const content = accordion.querySelector('[data-faq-content]');

    toggle.onclick = () => {
      if (content.style.maxHeight) {
        close(accordion);
      } else {
        faqItems.forEach((accordion) => close(accordion));
        open(accordion);
      }
    };
  });

  const open = (faq) => {
    const content = faq.querySelector('[data-faq-content]');
    faq.classList.add('open');
    content.style.maxHeight = content.scrollHeight + 'px';
  };

  const close = (faq) => {
    const content = faq.querySelector('[data-faq-content]');
    faq.classList.remove('open');
    content.style.maxHeight = null;
  };

}

document.addEventListener('DOMContentLoaded', function () {
  let blocks = document.querySelectorAll('[data-faq-block]');
  blocks.forEach((block) => {
    initializeBlock(block);
  });
});
