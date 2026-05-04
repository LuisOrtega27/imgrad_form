import {handleUpdate} from "./formActions"
import {getRegistry} from "./getRegistry"

const new_btn = document.querySelector("#main_menu__createRegistry")
const update_btn = document.querySelector("#main_menu__updateRegistry")

const history_btn = document.querySelector("#main_menu__showHistory")
const history_nav = document.querySelector(".menu_history")

const modalNewRegistry = document.querySelector('#modal-new_Registry');

history_btn.addEventListener("click", ()=>{
    history_nav.classList.toggle("showHistory")
})

update_btn.addEventListener("click", ()=>{
    handleUpdate()
})

new_btn.addEventListener("click", ()=>{
    getRegistry()
})