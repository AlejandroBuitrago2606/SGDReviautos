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

document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function () {
        alert('Editando documento...');
    });
});

document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        if (confirm('¿Está seguro de que desea eliminar este documento?')) {
            alert('Documento eliminado');
        }
    });
});

document.querySelector('.btn-add-top').addEventListener('click', function () {
    alert('Agregando nuevo documento...');
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