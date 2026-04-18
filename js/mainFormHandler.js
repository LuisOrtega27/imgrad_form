"use strict";

// const mainForm_submitBtn = document.getElementById('main_form-submit');
const mainForm = document.getElementById('main_form');

mainForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(mainForm);
    const data = Object.fromEntries(formData);
    console.log(data);
});

const fillInputs = (data) => {
    
    for (const [key, value] of Object.entries(data)) {

        const input = document.getElementsByName(key);

        input[0].value = value;

        // console.log(input);
        // console.log(`Input ${key} filled with value: ${value}`);

    }
}

export { fillInputs };