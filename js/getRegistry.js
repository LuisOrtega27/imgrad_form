'use strict';

import { fillInputs } from './mainFormHandler.js';


const getRegistry = (id = null) => {



    // if id is null, get the last registry id from the database, otherwise get the registry with the given id    
    try{

        const PATH = "php/getLastId.php";
        const FETCH_CONFIG = {
            headers: {
                "Content-Type": "application/json"
            },
            method: 'POST',
            body: JSON.stringify({ id })
        };

        
        fetch(PATH, FETCH_CONFIG)
        .then(response=> {
            if(!response.ok) {
                throw new Error(`Fetch error ${response.status} ${response.statusText} for ${response.url}`);
            }
            return response.json()
        })
        .then(data=>{
            // show modal whit spinner while processing the request
            // const spinner = document.querySelector('#modal-spinner');
            // spinner.style.display = 'block';
            
            // console.log(data);

            fillInputs(data);
            
            // show success message and close modal
            // alert('Registro agregado exitosamente');
        })

    }catch(error){
        console.error('Error:', error);
    }
}

export {getRegistry};