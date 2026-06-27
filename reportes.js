function abrirMenu() {
    const menu = document.getElementById("menuLateral");
    menu.classList.toggle("activo");
}
document.addEventListener("click", function(event){
    const menu = document.getElementById("menuLateral");
    const boton = document.querySelector(".menu-icono");
    if(
        !menu.contains(event.target) &&
        !boton.contains(event.target)
    ){
        menu.classList.remove("activo");
    }
});