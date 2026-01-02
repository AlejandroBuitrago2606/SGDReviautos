



// Verificar si se debe abrir la modal al cargar la página
if (window.location.search.includes('openModal=true')) {
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('staticBackdrop');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    });
}





//Detectar el btn que abre la modal
document.querySelectorAll('.btn-acceso').forEach(btn => {
    btn.addEventListener('click', function (event) {
        event.preventDefault(); // evita navegación normal

        const docId = this.getAttribute('data-doc-id');
        const url = `acceso/${docId}`;

        // 1) Hacer la solicitud GET
        fetch(url, { method: 'GET' })
            .then(response => {
                // no esperamos que retorne datos útiles en este caso
                // si quieres, puedes comprobar response.ok
                if (!response.ok) {
                    console.warn('La solicitud no devolvió OK:', response.status);
                }
                return response.text(); // o .json() si aplica
            })
            .then(_data => {
                // La respuesta no importa tanto; podrías opcionalmente
                // cambiar el contenido del modal o cerrar el modal tras un tiempo.
                console.log('Proceso completado para docId:', docId);
                // 2) Recargar la página con parámetro para abrir modal
                window.location.href = 'indexDocumentos?openModal=true';
            })
            .catch(err => {
                console.error('Error durante la solicitud GET:', err);
                // Opcional: mostrar mensaje de error en modal (antes de recargar)
                const modalEl = document.getElementById('staticBackdrop');
                modalEl.querySelector('.modal-body').innerText = 'Ocurrió un error al procesar el acceso.';
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            });
    });
});



document.querySelectorAll('.toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const targetSelector = btn.getAttribute('data-target');
        const contentEl = document.querySelector(targetSelector);

        const isOpen = btn.classList.contains('opened');

        if (isOpen) {

            // cerrar
            contentEl.classList.remove('open');
            btn.classList.remove('opened');
        } else {

            // abrir
            contentEl.classList.add('open');
            btn.classList.add('opened');
        }
    });
});



