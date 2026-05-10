"use strict"

const API_KEY = "AIzaSyAPA21v1E06YuptbIYOjUp9Fd2VtOZ9BIA"

// MAP MODAL
const modal_map = document.querySelector("#modal-map")
const modal_map_btn = document.querySelector("#modal-map-btn")

// ACTION: open map
modal_map_btn.addEventListener("click",(event)=>{
    event.preventDefault()
    modal_map.showModal()

})


async function  initMap(){
    
    let coord = {
        lat: document.querySelector("#coor_utm__e").value == "" ?? -34.5956145,
        lng: document.querySelector("#coor_utm__n").value == "" ?? -58.4431949,
    };
    
    
    const {event} = await google.maps.importLibrary("core")

    console.log(event)

}