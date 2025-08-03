
const initializeBlock = function (block) {
    const form = block.querySelector('form.quiz-form');

    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'At least one checkbox must be selected.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();

    function calculatePercentage(amount, total) {
        if (total === 0) {
            return 0;
        }
        return (amount / total) * 100;
    }

    function animateNumber(element, start, end, duration) {
        const range = end - start;
        let startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            element.innerText = Math.floor(progress * range + start);
            if (progress < 1) {
                requestAnimationFrame(step);
            }
        }

        requestAnimationFrame(step);
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const widgetId = form.id;
        const postId = form.getAttribute('post_id');
        const checkboxes = form.querySelectorAll('input[name="acf_buttons[]"]');
        const [ submitBtn ] = form.getElementsByTagName('button');
        const spinner = form.querySelector('.spinner');

        submitBtn.disabled = true;
        spinner.style.display = 'block';

        const selected = [];
        const notSelected = [];

        checkboxes.forEach(cb => {
            if (cb.checked) {
                selected.push(cb.value);
            } else {
                notSelected.push(cb.value);
            }
        });

        const formData = new FormData();
        formData.append('action', 'acf_button_widget');
        formData.append('nonce', acfWidgetAjax.nonce);
        formData.append('widget_id', widgetId);
        formData.append('selected', JSON.stringify(selected));
        formData.append('not_selected', JSON.stringify(notSelected));
        formData.append('post_id', postId);

        fetch(acfWidgetAjax.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(response => {
            form.setAttribute('quiz-has-answers', true)
            const total = Object.values(response.data.updated_counts).reduce((t, c) => t + c, 0);

            Object.keys(response.data.updated_counts).map((answer) => ({answer, answerWS: answer.replace(/ /g, '')})).forEach(({answer, answerWS}) => {
                const countBox = form.querySelector(`[quiz-answer="${answerWS}"] .count`);
                if (countBox) {
                    animateNumber(countBox, 0, response.data.updated_counts[answer], 2000);
                }
                const answerProgress = form.querySelector(`[quiz-answer="${answerWS}"] .answer-progress`);
                if (answerProgress) {
                    const progress = calculatePercentage(response.data.updated_counts[answer], total);
                    answerProgress.style.width = `${progress}%`;
                }
                const checkbox = form.querySelector(`[quiz-answer="${answerWS}"] input[type="checkbox"]`);
                if (checkbox) {
                    checkbox.disabled = true;
                }
            });

            spinner.style.display = 'none';
        })
        .catch(() => {
            document.getElementById(widgetId + '-result').innerHTML = '<p style="color:red">AJAX Error!</p>';
        });
    });
}
document.addEventListener('DOMContentLoaded', function () {
  let blocks = document.querySelectorAll('[data-quiz-block]');
  blocks.forEach((block) => {
    initializeBlock(block);
  });
});
