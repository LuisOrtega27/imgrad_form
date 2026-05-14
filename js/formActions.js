import { fillInputs } from './mainFormHandler.js';
import { updateRegistry } from './updateRegistry.js';


// ACTION: update
const handleUpdate = ()=>{

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

        if(!result?.success) return alert(result?.message)


        fillInputs(result.data);
        modalUpdateRegistry.close();

    });
}

export { handleUpdate }