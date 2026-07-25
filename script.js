document.addEventListener("DOMContentLoaded", () => {
    const btnDaltonismo = document.getElementById("btn-daltonismo");
    
    if (localStorage.getItem("modo-daltonismo") === "activado") {
        document.body.setAttribute("data-theme", "daltonismo");
    }

    if (btnDaltonismo) {
        btnDaltonismo.addEventListener("click", () => {
            if (document.body.getAttribute("data-theme") === "daltonismo") {
                document.body.removeAttribute("data-theme");
                localStorage.setItem("modo-daltonismo", "desactivado");
            } else {
                document.body.setAttribute("data-theme", "daltonismo");
                localStorage.setItem("modo-daltonismo", "activado");
            }
        });
    }
});

