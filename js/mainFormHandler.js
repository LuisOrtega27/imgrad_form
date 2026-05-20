"use strict";

import { setRegistry } from "./setRegistry.js";
import { getRegistry } from "./getRegistry.js";
import { updateJustAddRegistry } from "./updateJustAddRegistry.js"

const mainForm = document.getElementById('main_form');

const resetForm = () => {
    mainForm.reset();
    window.scrollTo({ top: 0, behavior: 'smooth' });
    // getRegistry();
}

mainForm.addEventListener('submit', async (e) => {

    e.preventDefault();
    
    document.querySelector("#main_menu__createRegistry").classList.remove("input-disabled")
    document.querySelector("#main_menu__updateRegistry").classList.remove("input-disabled");
    
    
    const formData = new FormData(mainForm);
    const data = Object.fromEntries(formData.entries());

    // console.log(data)
    
    let result;

    if(document.querySelector("#main_form-submit").getAttribute("data-update")){
        // si es una actualizacion
        result = await updateJustAddRegistry(data)
    }else{
        //si es nuevo
        result = await setRegistry(data);

    }

    
    if(result?.success){
        console.log(result)
        // alert('Registro guardado exitosamente');
        resetForm();
    }

});

const fillInputs = (data) => {
    
    console.log(data)
    
    for (let [dataKey, dataValue] of Object.entries(data)) {
        
        dataKey = dataKey.trim()
        dataValue = dataValue.trim()

        const input = document.getElementsByName(dataKey);

        // validar que sea type="checkbox/radio" y que coincida el "value", y usar "checked"
        if(input[0].type == "hidden" && input[0].name != "modification"){

            input.forEach((nodo)=>{
                if(nodo.value === dataValue) nodo.checked = true
            })
            
        }else{

            input[0].value = dataValue === "----" ? "" : dataValue;
        }

        
    }
    // console.log(data)
}

export { fillInputs };