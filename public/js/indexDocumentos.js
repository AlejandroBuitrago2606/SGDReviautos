// Event listeners para los botones


document.querySelectorAll('.btn-download').forEach(btn => {
    btn.addEventListener('click', function () {
        alert('Descargando documento...');
    });
});

document.querySelectorAll('.btn-view').forEach(btn => {
    btn.addEventListener('click', function () {
        alert('Visualizando documento...');
    });
});







var myModal = document.getElementById('staticBackdrop');
myModal.addEventListener('show.bs.modal', function (event) {
    // Botón que disparó el modal
    var button = event.relatedTarget;
    // Extraer el número del atributo data-number
    var number = button.getAttribute('data-number');
    // Colocar el número donde queremos
    var spanNumber = myModal.querySelector('#idDocumentoView');
    spanNumber.textContent = number;
    // Si usas input oculto para envío al servidor
    var hiddenInput = myModal.querySelector('#idDocumentoHidden');
    hiddenInput.value = number;
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