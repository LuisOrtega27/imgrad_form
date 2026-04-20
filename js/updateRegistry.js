"use strict";

const updateRegistry = (targetId)=>{

    const FILE_PATH = "php/getRegistry.php";
    const FETCH_OPTIONS = {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({targetId, last: true})
    };

    return fetch(FILE_PATH, FETCH_OPTIONS)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {

            // console.log(data)

            return data;
        })
        .catch(error => {
            console.error("Error al actualizar el registro:", error);
        });
}

export { updateRegistry };