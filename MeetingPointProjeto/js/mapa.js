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



var map = L.map('map').setView([40.6389, -8.6553], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Clicou em " + e.latlng.toString())
        .openOn(map);
}
map.on('click', onMapClick);

var marker = L.marker([40.63425, -8.631547]).addTo(map);