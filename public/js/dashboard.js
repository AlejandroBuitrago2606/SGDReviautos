
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



// Función para mostrar el formulario de edición
function mostrarFormProceso(event) {
  const btn = event.currentTarget;
  const id = btn.getAttribute("data-proceso-id");

  const formEditar = document.getElementById("formEditar" + id);
  const infoProceso = document.getElementById("infoProceso" + id);
  const btnEdit = document.getElementById("btnEdit" + id);
  const btnGuardar = document.getElementById("btnSave" + id);
  const btnEliminar = document.getElementById("btnEliminar" + id);
  const btnCancelarEdicion = document.getElementById("btnAtras" + id);

  if (!formEditar || !infoProceso) {
    console.error("No se encontró form o info para id", id);
    return;
  }

  // Alternar visibilidad
  if (formEditar.style.display === "none" || formEditar.style.display === "") {
    formEditar.style.display = "block";
    btnEdit.style.display = "none";
    btnGuardar.style.display = "block";
    infoProceso.style.display = "none";
    btnEliminar.style.display = "none";
    btnCancelarEdicion.style.display = "block";
  } else {
    formEditar.style.display = "none";
    infoProceso.style.display = "block";
    btnEdit.style.display = "block";
    btnGuardar.style.display = "none";
    btnEliminar.style.display = "block";
    btnCancelarEdicion.style.display = "none";

  }
}


function mostrarFormCategory(event) {
  const btn = event.currentTarget;
  const id = btn.getAttribute("data-category-id");

  const formEditar = document.getElementById("formEditarCategory" + id);
  const infoProceso = document.getElementById("infoCategory" + id);
  const btnEdit = document.getElementById("btnEditCategory" + id);
  const btnGuardar = document.getElementById("btnSaveCategory" + id);
  const btnEliminar = document.getElementById("btnDeleteCategory" + id);
  const btnCancelarEdicion = document.getElementById("btnBackCategory" + id);

  if (!formEditar || !infoProceso) {
    console.error("No se encontró form o info para id", id);
    return;
  }

  // Alternar visibilidad
  if (formEditar.style.display === "none" || formEditar.style.display === "") {
    formEditar.style.display = "block";
    btnEdit.style.display = "none";
    btnGuardar.style.display = "block";
    infoProceso.style.display = "none";
    btnEliminar.style.display = "none";
    btnCancelarEdicion.style.display = "block";
  } else {
    formEditar.style.display = "none";
    infoProceso.style.display = "block";
    btnEdit.style.display = "block";
    btnGuardar.style.display = "none";
    btnEliminar.style.display = "block";
    btnCancelarEdicion.style.display = "none";

  }
}





const greetingEl = document.getElementById("greeting");
const hour = new Date().getHours();
let saludo = "";

if (hour < 12) {
  saludo = "Buenos días 😊";
} else if (hour < 18) {
  saludo = "Buenas tardes ☀️";
} else {
  saludo = "Buenas noches 🌙";
}

greetingEl.textContent = saludo;
