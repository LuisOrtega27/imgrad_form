"use strict"

// CODIGO DE FICHA
document.querySelector("#ficha_n").addEventListener("input", (event)=>{
    
    let input = event.target;
    
    let stringValue = input.value.replace(" ", "").trim();    
    
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

    if(aceptedValues.find(item => item == event.data) === undefined) {
        input.value = stringValue.slice(0,-1);
        return
    }

    // TODO condicional para dividir por 2 o 3 valores
    if(stringValue.length === 2 || stringValue.length === 5 || stringValue.length === 8 || stringValue.length === 12)
        stringValue +="-";
        // Me rendi, solo pon el condenado guion en el string

    event.target.value = stringValue.toUpperCase()
})


// TELF 1234-1234567
document.querySelectorAll("input[type=tel]").forEach(currentInput =>{
    currentInput.addEventListener("input",(event)=>{
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

    if(phone.length === 4 && event.inputType !== "deleteContentBackward") phone += "-";

        event.target.value = phone
    });
})


