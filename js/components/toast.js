"use strict"
class Toast{

    constructor(toastContainer){
        this.toastContainer = document.getElementById(toastContainer);;
    }

    newToast(color, message){
        const toast = document.createElement("DIV");
        toast.className = `toast ${color}`;
        toast.innerHTML = `
            <div class="icon"></div>
            <p class="message">${message}</p>
        `;

        setTimeout(()=>{
            this.toastContainer.removeChild(toast);
        },3000)

        this.toastContainer.appendChild(toast);

    }
    
}

const toast = new Toast("toast-container");

export default toast;