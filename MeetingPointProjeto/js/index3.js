const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn-mobile");
const closeBtn = document.querySelector("#close-btn");
const closebutao = document.querySelector("#closebtn");
const btnabrir = document.querySelector('#btn-abrir');





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
    document.getElementById("mySidebar").style.width = "min-content";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("formulario").style.display = "block";
    document.getElementById("tabelacrud").style.display = "block";
    document.getElementById("closeside").style.display = "flex";
    //closebutao.setAttribute.style.display = "flex";
    document.getElementById("abrirside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "16rem auto";
    document.getElementById("nomeProjeto").style.display = "block";
    document.getElementById("profile").style.display = "block";
    document.getElementById("logout").style.display = "block";
    document.getElementById("nomeProjeto").style.marginTop = "-1rem";   

}

function closeNav() {
    document.getElementById("mySidebar").style.width = "100px";
    document.getElementById("dashboard").style.display = "none";
    document.getElementById("formulario").style.display = "none";
    document.getElementById("tabelacrud").style.display = "none";
    document.getElementById("abrirside").style.display = "block";
    document.getElementById("closeside").style.display = "none";
    //closebutao.setAttribute.style.display = "none";
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



