"use strict"

async function reserveID(){
    
    try{

        const fetchConfig = {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        }

        const response = await fetch("./php/api/ficha_eoh.php", fetchConfig);
        
        if(!response.ok) throw new Error(`Response not OK :( \n ${response.status}`);

        const data = await response.json();
        
        return data.data;

    }catch(e){
        console.log(`ERROR: ${e}`);
    }


}

export default reserveID;