const initializeBlock = function (block) {
  let form = block.querySelector('form.wpcf7-form');
  let formBody = block.querySelector('[data-form-body]');
  let thankYou = block.querySelector('[data-thank-you]');

  const apiURL = 'https://pongping.net/contact/telegram';

  form.addEventListener('wpcf7mailsent', async(e) => {

    const formData = createFormData(e.detail.inputs)

    if (thankYou) {
      formBody.classList.add('d-none');
      thankYou.classList.remove('d-none');
    }

    try {
      const result = await sendFormData(formData);
      console.log(result);
    } catch (error) {
      console.log('Error:', error);
    }
  });

  async function sendFormData(formData) {
    const response = await fetch(apiURL, {
      method: 'POST',
      body: JSON.stringify(formData),
      headers: {
        'Content-Type': 'application/json'
      }
    });

    return response.text();
  }

  function createFormData(inputs) {
    const formData = {
      domain: window.location.hostname
    };

    inputs.forEach((item) => {
      formData[item.name] = item.value;
    });

    return formData;
  }

}

document.addEventListener('DOMContentLoaded', function () {
  let blocks = document.querySelectorAll('[data-contact-form-block]');
  blocks.forEach((block) => {
    initializeBlock(block);
  });
});
