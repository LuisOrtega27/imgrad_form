"use strict";

const setRegistry = (data)=>{

    const FILE_PATH = 'php/setRegistry.php';
    const FETCH_CONFIG = {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({data})
    }
    
    try{
        return fetch(FILE_PATH, FETCH_CONFIG)
        .then(response => {
            if(!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            return data;
        })
        .catch(error => {
            console.error('Catch: Error fetching registry data:', error);
        });
    }catch(e){
        console.error('TryCatch: Error fetching registry:', e);
    }
}

export { setRegistry };