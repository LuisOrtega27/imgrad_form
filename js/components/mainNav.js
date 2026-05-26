"use strict"

import  {reserveID} from "../services/ficha_eoh.js"

import form from "./mainForm.js"
import toast from "./toast.js"

class MainNav{
    constructor(createBtnId, updateBtnId){
        this.nav = document.querySelector("#main_menu")
        this.createBtn = document.querySelector(`#${createBtnId}`)
        this.updateBtn = document.querySelector(`#${updateBtnId}`)

        if (this.createBtn) {
            this.createBtn.addEventListener("click", (e)=>{
                if(e.target === this.createBtn){
                    this.disableBtns()

                    reserveID().then(ID =>{

                        // alert("Nuevo ID reservado")
                        toast.newToast("success", `ID: ${ID} reservado!`)
                        form.set_Id(ID)
                        // console.log(ID)
                    })

                }
            })
        }
    }

    disableBtns(){
        if (this.createBtn) this.createBtn.classList.add("input-disabled");
        if (this.updateBtn) this.updateBtn.classList.add("input-disabled");
    }
    enableBtns(){
        if (this.createBtn) this.createBtn.classList.remove("input-disabled");
        if (this.updateBtn) this.updateBtn.classList.remove("input-disabled");
    }

}

const mainNav = new MainNav("main_menu__createRegistry", "main_menu__updateRegistry")

export default mainNav;