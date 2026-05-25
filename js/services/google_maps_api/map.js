"use strict"

import { decimalToUTM } from "./convert_coord_deci_utm.js"

// const API_KEY = "AIzaSyAPA21v1E06YuptbIYOjUp9Fd2VtOZ9BIA"

// MAP MODAL
const modal_map = document.querySelector("#modal-map")
const modal_map_btn = document.querySelector("#modal-map-btn")
const mapElement = document.querySelector("#map")

const place_input = document.querySelector("#place-autocomplete")

// ACTION: open map
modal_map_btn.addEventListener("click",(event)=>{
    event.preventDefault()
    modal_map.showModal()

})

let coord_e = document.querySelector("#coor_utm__e");
let coord_n = document.querySelector("#coor_utm__n");

const coords = {
    lat: coord_e.value == "" ? 10.500309 : coord_e.value,
    lng: coord_n.value == "" ? -66.9174352 : coord_n.value,
};

window.initMap = async ()=>{

    // Importar las librerías necesarias
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    const { PlaceAutocompleteElement, Autocomplete } = await google.maps.importLibrary("places");
  
    const map = new Map(mapElement, {
        mapId: "DEMO_MAP_ID",
        zoom: 14,
        center: coords
    })
    map.addListener("click", (event)=>{
        placeMarker(event.latLng, marker)
    })

    const marker = new AdvancedMarkerElement({
        position: coords,
        map
    })

    place_input.addEventListener("gmp-placeselect", (event) => {
        const place = event.detail.place;

        if (!place.geometry || !place.geometry.location) {
            return;
        }
        // Mover el mapa y el marcador
        map.setCenter(place.geometry.location);
        marker.position = place.geometry.location;
        map.setZoom(17);
    })

    // // Esto convierte tu input normal en el buscador de Google
    // const autocomplete = new Autocomplete(place_input);
    // autocomplete.bindTo("bounds", map);

    // autocomplete.addListener("place_changed", () => {
    //     const place = autocomplete.getPlace();
    //     if (place.geometry) {
    //         map.setCenter(place.geometry.location);
    //         marker.position = place.geometry.location;
    //     }
    // });
    
    // searchGoogleMap(map)
}

const placeMarker = async (latLng, marker)=>{
    // change coordinates
    coords.lat = latLng.lat();
    coords.lng = latLng.lng();

    // move marker
    marker.position = coords;
    
    // update inputs
    let coordsUTM = await decimalToUTM(coords.lat, coords.lng)

    // console.log(decimalToUTM)
    
    coord_e.value = coordsUTM.easting
    coord_n.value = coordsUTM.northing
}

const searchGoogleMap = (map)=>{
    // autocomplete = new google.maps.places.PlaceAutocompleteElement(place_input)
    // autocomplete.addListener("place_changed", ()=>{
    //     const place = autocomplete.getPlace()
    //     map.setCenter(place.geometry.location)
    //     map.setZoom(14)
    // })    

    // 2. Vincula el input HTML
    // const autocomplete = new google.maps.places.Autocomplete(input);

    // 3. (Opcional) Sesgar la búsqueda a lo que se ve en el mapa
    // autocomplete.bindTo("bounds", map);
}
