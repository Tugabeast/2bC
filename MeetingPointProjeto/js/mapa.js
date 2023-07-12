const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn-mobile");
const closeBtn = document.querySelector("#close-btn");
const closebutao = document.querySelector("#closebtn");
const btnabrir = document.querySelector('#btn-abrir');







function openNav() {
    document.getElementById("mySidebar").style.width = "min-content";
    document.getElementById("main").style.marginLeft = "0px";
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("formulario").style.display = "block";
    document.getElementById("tabelacrud").style.display = "block";


    document.getElementById("closeside").style.display = "flex";
    document.getElementById("abrirside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "16rem auto";
    document.getElementById("nomeProjeto").style.display = "block";
    document.getElementById("profile").style.display = "block";
    document.getElementById("logout").style.display = "block";
    document.getElementById("nomeProjeto").style.marginTop = "-1rem";


}

function closeNav() {
    document.getElementById("mySidebar").style.width = "100px";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("dashboard").style.display = "none";
    document.getElementById("formulario").style.display = "none";
    document.getElementById("tabelacrud").style.display = "none";
    document.getElementById("abrirside").style.display = "block";
    document.getElementById("closeside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "7rem auto";
    document.getElementById("nomeProjeto").style.display = "none";
    document.getElementById("profile").style.display = "none";
    document.getElementById("logout").style.display = "none";
}


function openNavMobile() {
    document.getElementById("close-btn-teste-mobile").style.display = "flex";
    sideMenu.style.display = 'block';
    document.querySelector(".right .topo").style.backgroundColor = "white";

}

function closeNavMobile() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("close-btn-teste-mobile").style.display = "none";
    sideMenu.style.display = 'none';
    menuBtn.style.color = 'white';
    document.querySelector(".right .topo").style.backgroundColor = "#094b9b";

}











const map = L.map('map').setView([40.781222457545134, -8.573946680684655], 15);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const marker = L.marker([40.781222457545134, -8.573946680684655]).addTo(map).openPopup();

function formula(velocidade, time) {
    return (velocidade * (100 / 6)) * time;
}

let direct = windDirection;

let Circle = L.semiCircle([40.781222457545134, -8.573946680684655], {
    color: 'red',
    fillColor: 'transparent',
    fillOpacity: 0.5,
    radius: formula(velocity, 5)
}).setDirection(direct, 45).addTo(map);

let circle2 = L.semiCircle([40.781222457545134, -8.573946680684655], {
    color: 'red',
    fillColor: 'transparent',
    fillOpacity: 0.5,
    radius: formula(3, 10)
}).setDirection(direct, 45).addTo(map);

/*
const polygon = L.polygon([
    [40.781222457545134, -0.08],
    [40.781222457545100, -0.06],
    [40.881222457545134, -0.047]
]).addTo(map).bindPopup('Zona-Ventos');

const popup = L.popup()
    .setLatLng([40.781222457545134, -8.573946680684655])
    .setContent('Cires - Wind SenSor [Ventos]')
    .openOn(map);

// Ajustar a posição da rosa dos ventos para começar na primeira imagem do mapa
const markerLatLng = marker.getLatLng();
const circleLatLng = circle.getLatLng();
const markerOffset = L.latLng(markerLatLng.lat - (circleLatLng.lat - markerLatLng.lat), markerLatLng.lng - (circleLatLng.lng - markerLatLng.lng));
circle.setLatLng(markerOffset);

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent(`You clicked the map at ${e.latlng.toString()}`)
        .openOn(map);

    // Atualizar a posição da rosa dos ventos quando o popup for movido
    const markerLatLng = marker.getLatLng();
    //const circleLatLng = circle.getLatLng();
    const markerOffset = L.latLng(markerLatLng.lat - (circleLatLng.lat - markerLatLng.lat), markerLatLng.lng - (circleLatLng.lng - markerLatLng.lng));
    circle.setLatLng(markerOffset);
}

map.on('click', onMapClick);



// Zoom in on the first image of the map
//map.setZoom(17);
*/