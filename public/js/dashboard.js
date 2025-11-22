document.querySelectorAll('.menu-header').forEach(header => {
    header.addEventListener('click', function () {
        const chevron = this.querySelector('.chevron');
        chevron.classList.toggle('active');
    });
});



function toggleSubmenu(element) {
    const menuItem = element.parentElement;
    const wasActive = menuItem.classList.contains('active');

    // Cerrar todos los menús
    document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
    });

    // Abrir el menú clickeado si no estaba activo
    if (!wasActive) {
        menuItem.classList.add('active');
    }
}