



function openNav() {
    document.getElementById("mySidebar").style.width = "min-content";
    document.getElementById("main").style.marginLeft = "0px";
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("localizacao").style.display = "block";
    document.getElementById("consulta").style.display = "block";
    document.getElementById("historico").style.display = "block";
    document.getElementById("controlo").style.display = "block";



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
    document.getElementById("localizacao").style.display = "none";
    document.getElementById("consulta").style.display = "none";
    document.getElementById("historico").style.display = "none";
    document.getElementById("controlo").style.display = "none";

    document.getElementById("abrirside").style.display = "block";
    document.getElementById("closeside").style.display = "none";
    document.getElementById("container").style.gridTemplateColumns = "7rem auto";
    document.getElementById("nomeProjeto").style.display = "none";
    document.getElementById("profile").style.display = "none";
    document.getElementById("logout").style.display = "none";
}