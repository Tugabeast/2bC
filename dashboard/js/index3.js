const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
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
    sideMenu.style.display
})




function openNav() {
    document.getElementById("mySidebar").style.width = "min-content";
    document.getElementById("main").style.marginLeft = "0px";
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("formulario").style.display = "block";
    document.getElementById("tabelacrud").style.display = "block";
    document.getElementById("mapa").style.display = "block";
    document.getElementById("graficos").style.display = "block";
    document.getElementById("componentes").style.display = "block";
    document.getElementById("closeside").style.display = "flex";
    document.getElementById("abrirside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "14rem auto";
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
    document.getElementById("mapa").style.display = "none";
    document.getElementById("graficos").style.display = "none";
    document.getElementById("componentes").style.display = "none";
    document.getElementById("abrirside").style.display = "block";
    document.getElementById("closeside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "7rem auto";
    document.getElementById("nomeProjeto").style.display = "none";
    document.getElementById("profile").style.display = "none";
    document.getElementById("logout").style.display = "none";
}