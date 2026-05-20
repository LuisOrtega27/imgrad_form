"use strict"

// (FORMATO) CODIGO DE FICHA

const codelimits = ()=>{
    
}

document.querySelector("#ficha_n").addEventListener("input", (event)=>{
    
    if(event.inputType === "deleteContentBackward") return

    let input = event.target;
    
    let stringValue = input.value.toUpperCase().replace(" ", "").trim();    
    // stringValue = stringValue

    // EVITAR: espacios en blanco " " & guiones "-"
    const aceptedValues = [
        "a", "b", "c", "d", "e",
        "f", "g", "h", "i", "j",
        "k", "l", "m", "n", "ñ",
        "o", "p", "q", "r", "s", 
        "t", "u", "v", "w", "x", 
        "y", "z", 
        0, 1, 2, 3, 4, 
        5, 6, 7, 8, 9
    ];

    if(aceptedValues.find(item => item == event.data) === undefined)
        return input.value = stringValue.slice(0,-1);

    // TODO condicional para dividir por 2 o 3 valores
    if(stringValue.length === 3 || stringValue.length === 6 || stringValue.length === 9 || stringValue.length === 13){
        let lastChart = stringValue.slice(stringValue.length-1, stringValue.length)
        stringValue = `${stringValue.slice(0,-1)}-${lastChart}`;
        // Me rendi, solo pon el condenado guion en el string
    }

    let arrayValues = stringValue.toUpperCase().split("-")

    // 1. codigo entre 01 y 02 (letras no)
    if( 
        arrayValues[0].charAt(0) > 0 
        || arrayValues[0] > 2 
        || arrayValues[0]=="00"
        || isNaN(arrayValues[0])
    ){
        arrayValues[0] = arrayValues[0].slice(0,-1)
        // console.log(1)
    }

    // 2. codigo (si 1. == 01): 2. entre 01 y 19 (letras no)
    // 2. codigo (si 1. == 02): 2. entre 01 y 05 (letras no)
    if( 
        arrayValues[0] == 1 && arrayValues[1] > 19 
        || 
        isNaN(arrayValues[1]) && arrayValues[1] != undefined
    ){
        arrayValues[1] = arrayValues[1]?.slice(0,-1)
        // console.log(2)
    }
    else if( arrayValues[0] == 2 && arrayValues[1] > 5 ){
        arrayValues[1] = arrayValues[1].slice(0,-1)
        // console.log("2.5")
    }
    
    // 3. codigo entre 01 y 22 (letras no)
    if( 
        arrayValues[2] > 22 
        || 
        isNaN(arrayValues[2]) && arrayValues[2] != undefined 
    ){
        arrayValues[2] = arrayValues[2]?.slice(0,-1)
        // console.log(3)
    }

    // 4. codigo solo letras
    if( !isNaN(arrayValues[3]?.slice( arrayValues[3]?.length -1, arrayValues[3]?.length )) ){
        arrayValues[3] = arrayValues[3].slice(0,-1)
        // console.log(4)
    }

    // 5. codigo n cantidad (letras no)
    if(
        isNaN(arrayValues[4]) && arrayValues[4] !== undefined
    ){
        arrayValues[4] = arrayValues[4].slice(arrayValues.length-1, arrayValues.length)
    }


    event.target.value = arrayValues.join("-")
})


// (FORMATO) TELF 1234-1234567
document.querySelectorAll("input[type=tel]").forEach(currentInput =>{

    currentInput.addEventListener("input", (event)=>{

        // no formatear el texto cuando se borra un caracter (genera problemas)
        if(event.inputType === "deleteContentBackward") return

        let phone = event.target.value;

        const aceptedValues = [
            0, 1, 2, 3, 4, 
            5, 6, 7, 8, 9
        ];
        
        // Aceptar solo numeros
        if(aceptedValues.find(item => item == event.data) === undefined) {
            phone = phone.slice(0,-1);
        }

        // inclluir guion
        if( !phone.includes("-") && phone.length === 5 ) {
            let last = phone.slice(phone.length-1, phone.length);
            phone = phone.slice(0, -1);
            phone += "-" + last;
        }

        event.target.value = phone;

    });
})


