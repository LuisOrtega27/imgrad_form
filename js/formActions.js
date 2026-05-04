import { fillInputs } from './mainFormHandler.js';
import { updateRegistry } from './updateRegistry.js';


// NEW REGISTRY MODAL
const modalNewRegistry = document.querySelector('#modal-new_Registry');


// ACTION: update
const handleUpdate = ()=>{
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
}

export { handleUpdate }