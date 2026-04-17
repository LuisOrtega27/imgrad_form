'use strict'

window.addEventListener('DOMContentLoaded', () => {

    // NEW REGISTRY MODAL
    const modalNewRegistry = document.querySelector('#modal-new_Registry');

    // MODAL CONTROLS
    const closeModalBtns = document.querySelectorAll('.modal-close_btn');
    const ReturnModalBtn = document.querySelector('#modal-btn_return');

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


    newRegistryBtn.addEventListener('click', () => {
        // fetch('http://localhost/imgrad_form/php/addRegistry.php')
        //     .then(response => response.json())
        //     .then(data => {
        //         console.log(data);
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //     });
    });

    updateRegistryBtn.addEventListener('click', () => {
        // cerrar modal actual y abrir modal con formulario para buscar registro a actualizar
        modalNewRegistry.close();

        // Open the update registry modal
        const modalUpdateRegistry = document.querySelector('#modal-update_Registry');
        modalUpdateRegistry.showModal();
    });

})