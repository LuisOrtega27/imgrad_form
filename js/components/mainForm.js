"use strict";

import { setRegistry } from "../services/ficha_eoh.js"
import mainNav from "./mainNav.js";
import toast from "./toast.js";

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

            const result = await setRegistry(dataObj);

            if(result.status === "success"){
                console.log(result)
                toast.newToast("success", "Nuevo registro agregado!");
                this.resetForm();
            }
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
        window.scrollTo({
            top: 0,
            left: 0,  
            behavior: 'smooth'
        });
        mainNav.enableBtns()
    }

    disableRequired(){
        const inputList = this.html.querySelectorAll("input")
        inputList.forEach(input => input.removeAttribute("required"))
    }
}



const form = new MainForm();

export default form;