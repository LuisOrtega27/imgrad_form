"use strict";

class MainForm{

    constructor(){
        this.html = document.querySelector("#main_form");

        this.handleSubmit()

        this.disableRequired()

    }

    async handleSubmit(){
        this.html.addEventListener("submit", async(event)=>{
            event.preventDefault()
            const formData = new FormData(event.target)
            const dataObj = Object.fromEntries(formData)

            const result = await api__set(dataObj);

            console.log(result)

        })
    }

    set_Id(id){
        const idInput = this.html.querySelector("#cod_n")
        idInput.value = String(id).padStart(6, "0")
    }

    fillForm(formData){

    }

    resetForm(){
        this.html.reset()
    }

    disableRequired(){
        const inputList = this.html.querySelectorAll("input")
        inputList.forEach(input => input.removeAttribute("required"))
    }
}



const form = new MainForm();

export default form;