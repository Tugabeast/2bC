const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");


//mostrar sidebard

    menuBtn.addEventListener('click', () => {
        sideMenu.style.display = 'block';
    });



//fechar sidebard
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});


/*
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
*/

//profile menu
function menuToggle() {
    const toggleMenu = document.querySelector('.menu-profile');
    toggleMenu.classList.toggle('active');

}

//alertas funcao
function alertasToggle() {
    const toggleAlert = document.querySelector('.alertas-context');
    toggleAlert.classList.toggle('active');
}


//mapa
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


//graficos
Dygraph.onDOMready(function onDOMready() {
    g = new Dygraph(

        // containing div
        document.getElementById("graphdiv"),

        // CSV or path to a CSV file.
        "Date,Temperature\n" +
        "2008-05-07,75\n" +
        "2008-05-08,70\n" +
        "2008-05-09,80\n" +
        "2008-05-10,70\n" +
        "2008-05-11,75\n" +
        "2008-05-12,80\n" +
        "2008-05-13,70\n" +
        "2008-05-14,65\n" +
        "2008-05-15,75\n"
    );
});