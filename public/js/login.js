document.addEventListener("DOMContentLoaded", function () {
    // Mostrar el mensaje
    const mensaje = document.getElementById("mensaje-restablecimiento");

    // Esperar 4 segundos (4000 ms) y desaparecer
    setTimeout(() => {
        mensaje.style.transition = "opacity 0.5s ease-out";
        mensaje.style.opacity = "0";

        // Luego de la transición, remover del DOM
        setTimeout(() => {
            mensaje.remove();
        }, 500); // igual al tiempo de la transición
    }, 4000); // tiempo visible antes de desaparecer
});