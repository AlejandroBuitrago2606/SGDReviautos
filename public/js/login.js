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




// Función para limpiar la URL después de POST de forgot-password
function limpiarURL() {
    const url = window.location.href;

    // Verificar si la URL contiene /forgot-password
    if (url.includes('/forgot-password')) {
        // Reemplazar la URL actual sin recargar la página
        window.history.replaceState({}, document.title, '/');
    }
}

// Ejecutar la función cuando cargue la página
document.addEventListener('DOMContentLoaded', function () {
    limpiarURL();

    // Mostrar el mensaje de restablecimiento si existe
    const mensajeRestablecimiento = document.getElementById('mensaje-restablecimiento');
    if (mensajeRestablecimiento && mensajeRestablecimiento.textContent.trim() !== '') {
        mensajeRestablecimiento.style.display = 'block';

        // Ocultar el mensaje después de 5 segundos
        setTimeout(() => {
            mensajeRestablecimiento.style.opacity = '0';
            setTimeout(() => {
                mensajeRestablecimiento.style.display = 'none';
            }, 300);
        }, 5000);
    }
});

// También limpiar si se navega con el botón de retroceso
window.addEventListener('popstate', function () {
    limpiarURL();
});