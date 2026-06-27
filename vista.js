let modoDaltonismo = localStorage.getItem("modoDaltonismo") === "true";

function aplicarTema(){

    const body = document.body;

    const botonesCafe = document.querySelectorAll(".btn-cafe");
    const botonesRojo = document.querySelectorAll(".btn-rojo");
    const titulos = document.querySelectorAll(".titulo");

    if(modoDaltonismo){

        body.style.background = "#FFFFFF";

        botonesCafe.forEach(function(boton){

            boton.style.background = "#005A9C";
            boton.style.color = "white";

        });

        botonesRojo.forEach(function(boton){

            boton.style.background = "#FFD600";
            boton.style.color = "black";

        });

        titulos.forEach(function(titulo){

            titulo.style.color = "#003366";
            titulo.style.textShadow = "none";

        });

    }

    else{

        body.style.background = "#F3EFE7";

        botonesCafe.forEach(function(boton){

            boton.style.background = "#B67D39";
            boton.style.color = "black";

        });

        botonesRojo.forEach(function(boton){

            boton.style.background = "#D32F2F";
            boton.style.color = "white";

        });

        titulos.forEach(function(titulo){

            titulo.style.color = "#D32F2F";
            titulo.style.textShadow = "2px 2px 5px black";

        });

    }

}

function Vista(){

    modoDaltonismo = !modoDaltonismo;

    localStorage.setItem("modoDaltonismo", modoDaltonismo);

    aplicarTema();

}

window.onload = aplicarTema;