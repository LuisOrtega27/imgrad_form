"use strict";

import { setRegistry } from "./setRegistry.js";
import { getRegistry } from "./getRegistry.js";

const mainForm = document.getElementById('main_form');

const resetForm = () => {
    mainForm.reset();
    window.scrollTo({ top: 0, behavior: 'smooth' });
    getRegistry();
}

mainForm.addEventListener('submit', async (e) => {

    e.preventDefault();
    const formData = new FormData(mainForm);
    const data = Object.fromEntries(formData.entries());

    const result = await setRegistry(data);
    
    if(result.success){
        alert('Registro guardado exitosamente');
        resetForm();
    }

});

const fillInputs = (data) => {
    
    // console.log(data)
    
    for (let [dataKey, dataValue] of Object.entries(data)) {
        
        dataKey = dataKey.trim()
        dataValue = dataValue.trim()

        // if(dataKey === "modification") continue; // Skip the historic modification field

        const input = document.getElementsByName(dataKey);

        // validar que sea type="checkbox/radio" y que coincida el "value", y usar "checked"
        if(input[0].type == "hidden" && input[0].name != "modification"){

            input.forEach((nodo)=>{
                if(nodo.value === dataValue) nodo.checked = true
            })
            
        }else{

            input[0].value = dataValue;
        }

        
    }
    // console.log(data)
}

export { fillInputs };