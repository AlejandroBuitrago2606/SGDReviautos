   function mostrarEditar(id) {
        document.getElementById('filaVista' + id).style.display = 'none';
        document.getElementById('filaEditar' + id).style.display = '';
    }

    function cancelarEditar(id) {
        document.getElementById('filaVista' + id).style.display = '';
        document.getElementById('filaEditar' + id).style.display = 'none';
    }