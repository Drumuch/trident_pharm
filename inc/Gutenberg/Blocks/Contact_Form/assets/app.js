const initializeBlock = function (block) {
  let form = block.querySelector('[data-form]');
  let formBody = block.querySelector('[data-form-body]');
  let thankYou = block.querySelector('[data-thank-you]');

  const apiURL = 'https://pongping.net/contact/telegram';

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = {
      domain: window.location.hostname,
      name: form.elements['name'].value,
      email: form.elements['email'].value,
      message: form.elements['message'].value,
    };

    // console.log(formData);

    try {
      const result = await sendFormData(formData);
      console.log(result);
      if (thankYou) {
        formBody.classList.add('d-none');
        thankYou.classList.remove('d-none');
      }
      form.reset();
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

}

document.addEventListener('DOMContentLoaded', function () {
  let blocks = document.querySelectorAll('[data-contact-form-block]');
  blocks.forEach((block) => {
    initializeBlock(block);
  });
});
