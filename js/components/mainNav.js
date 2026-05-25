"use strict"


import form from "./mainForm.js"
import  reserveID from "../services/reserveID.js"

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

                        form.set_Id(ID)
                        // console.log(ID)
                    })

                    alert("Nuevo ID reservado")
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

const main_nav = new MainNav("main_menu__createRegistry", "main_menu__updateRegistry")

// const new_btn = document.querySelector("#main_menu__createRegistry")
// const update_btn = document.querySelector("#main_menu__updateRegistry")





// update_btn.addEventListener("click", ()=>{
//     new_btn.classList.remove("input-disabled");
//     handleUpdate()
// })

// new_btn.addEventListener("click", ()=>{
//     new_btn.classList.add("input-disabled");
//     update_btn.classList.add("input-disabled");
//     alert("Nuevo ID reservado")
//     getRegistry()
// })