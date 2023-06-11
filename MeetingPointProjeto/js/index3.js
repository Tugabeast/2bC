const sideMenu = document.querySelector("#mySidebar");
const menuBtn = document.querySelector("#abrirside");
const closeBtn = document.querySelector("#closebtn");
const closeIcon = document.querySelector("#closeside");





//mostrar sidebard
menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});



//fechar sidebard
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

btnabrir.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})




function openNav() {
    //document.getElementById("mySidebar").style.width = "min-content";
    //document.getElementById("mySidebar").style.display = "block";
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("formulario").style.display = "block";
    document.getElementById("tabelacrud").style.display = "block";
    //document.getElementById("closeside").style.display = "flex";
    //document.getElementById("abrirside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "16rem auto";
    document.getElementById("nomeProjeto").style.display = "block";
    document.getElementById("profile").style.display = "block";
    document.getElementById("logout").style.display = "block";
    document.getElementById("nomeProjeto").style.marginTop = "-1rem";   
    sideMenu.style.width = "18rem";
    closeIcon.style.display = "flex";
    menuBtn.style.display = "none";
    
}

function closeNav() {
    //document.getElementById("mySidebar").style.width = "100px";
    document.getElementById("dashboard").style.display = "none";
    document.getElementById("formulario").style.display = "none";
    document.getElementById("tabelacrud").style.display = "none";
    //document.getElementById("abrirside").style.display = "block";
    //document.getElementById("closeside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "7rem auto";
    document.getElementById("nomeProjeto").style.display = "none";
    document.getElementById("profile").style.display = "none";
    document.getElementById("logout").style.display = "none";
    sideMenu.style.width = "0";
    closeIcon.style.display = "none";
    menuBtn.style.display = "block";

}

 

// Verificar se a janela é um dispositivo móvel
if (window.matchMedia("(max-width: 768px)").matches) {
    // Adicionar evento de clique ao botão "Menu" apenas para dispositivos móveis
    menuBtn.addEventListener("click", openNav);
  
    // Adicionar evento de clique ao botão "Fechar" apenas para dispositivos móveis
    closeBtn.addEventListener("click", closeNav);
  }




// Get the modal
var modal = document.getElementById("myModal");


// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

//quando clica em cancelar, fecha o modal
var cancelar = document.getElementsByClassName("cancelar");
cancelar.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$(document).ready(function() {
    $('.btnedit-utilizador').on('click', function() {
        $('#editmodal').modal('show');
    });
});



/*---------mapa---------*/
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