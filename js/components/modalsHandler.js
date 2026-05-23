'use strict'

import { handleUpdate } from './formActions.js';

window.addEventListener('DOMContentLoaded', () => {

    // NEW REGISTRY MODAL
    const modals = document.querySelectorAll('.modal');

    // MODAL CONTROLS
    const closeModalBtns = document.querySelectorAll('.modal-close_btn');
    // const ReturnModalBtn = document.querySelector('.modal-return_btn');

    // NEW REGISTRY FORM BUTTONS
    const updateRegistryBtn = document.querySelector('#modal-btn_update_Registry');



    // ACTION: close modal when clicking outside of it
    modals.forEach(modal=>{
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.close();
            }
        });
    }) 
    

    // ACTION: Close modal when clicking on close buttons
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', (event) => {
            event.target.parentNode.parentNode.close()
        });
    });



    
    updateRegistryBtn.addEventListener('click', () => {
        const submitBtn = document.querySelector("#main_form-submit")
        submitBtn.setAttribute("data-update", "true")
        handleUpdate()
    });

})