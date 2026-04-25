'use strict'

import {getRegistry}  from './getRegistry.js';
import { fillInputs } from './mainFormHandler.js';
import {updateRegistry} from './updateRegistry.js';

window.addEventListener('DOMContentLoaded', () => {

    // NEW REGISTRY MODAL
    const modalNewRegistry = document.querySelector('#modal-new_Registry');

    // MODAL CONTROLS
    const closeModalBtns = document.querySelectorAll('.modal-close_btn');
    const ReturnModalBtn = document.querySelector('.modal-return_btn');

    // NEW REGISTRY FORM BUTTONS
    const newRegistryBtn = document.querySelector('#modal-btn_new_Registry');
    const updateRegistryBtn = document.querySelector('#modal-btn_update_Registry');
    
    // UPDATE REGISTRY MODAL
    const modalUpdateRegistry = document.querySelector('#modal-update_Registry');

    // NEW REGISTRY MODAL: Always Open the modal when the page loads
    modalNewRegistry.showModal();

    // ACTION: Close modal when clicking on close buttons
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modalNewRegistry.close();
        });
    });

    // ACTION: Close modal when pressing Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalNewRegistry.open) {
            modalNewRegistry.close();
        }
    });

    // ACTION: close modal when clicking outside of it
    modalNewRegistry.addEventListener('click', (e) => {
        if (e.target === modalNewRegistry) {
            modalNewRegistry.close();
        }
    });

    // Action: close current modal and open the previous one
    ReturnModalBtn.addEventListener('click', () => {
        modalUpdateRegistry.close();
        
        modalNewRegistry.showModal();
    });

    // Action: handle new registry form submission, request for last registry id
    newRegistryBtn.addEventListener('click', () => {

        // Call the searchRegistry function without an ID to get the last registry
        getRegistry();
        modalNewRegistry.close();
    });

    updateRegistryBtn.addEventListener('click', () => {
        // cerrar modal actual y abrir modal con formulario para buscar registro a actualizar
        modalNewRegistry.close();

        // Open the update registry modal
        const modalUpdateRegistry = document.querySelector('#modal-update_Registry');
        modalUpdateRegistry.showModal();

        const form__update_Registry = document.querySelector(".form-update_Registry");

        form__update_Registry.addEventListener("submit", async(e)=>{
            e.preventDefault();

            let formData = new FormData(form__update_Registry);
            formData = Object.fromEntries(formData.entries());

            const targetId = formData.search_registry;
            let result = await updateRegistry(targetId);

            if(!result?.success) return alert(result.message)


            fillInputs(result.data);
            modalUpdateRegistry.close();

        });
        
    });

})