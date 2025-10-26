
//Validacion de archivos antes de subirlos
const input = document.getElementById('archivo');
const msg = document.getElementById('msg');

const maxSize = 50 * 1024 * 1024; // Tamaño maximo en bytes 50MB  
const allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png']; // Extensiones permitidas

input.addEventListener('change', () => {
  const files = Array.from(input.files);
  const invalid = [];

  files.forEach(file => {
    const ext = file.name.split('.').pop().toLowerCase();
    if (!allowed.includes(ext) || file.size > maxSize) invalid.push(file.name);
  });

  if (invalid.length) {
    msg.textContent = `❌ Archivos inválidos o mayores a 5MB: ${invalid.join(', ')}`;
    input.value = '';
  } else {
    msg.textContent = '✅ Archivos válidos.';
  }
});




//Lógica para eliminar archivo adjuntado previamente
document.addEventListener('DOMContentLoaded', function () {
    const btnEliminar = document.getElementById('btn-eliminar-archivo');
    const inputRuta = document.getElementById('rutaArchivo');
    const fileInput = document.getElementById('archivo');
    const previewDiv = document.getElementById('preview-file');

    btnEliminar.addEventListener('click', function () {
        // Limpiar el valor del hidden que almacena la ruta
        inputRuta.value = '';

        // Ocultar la vista previa
        previewDiv.style.display = 'none';

        // Mostrar el campo file
        fileInput.style.display = 'inline-block';
    });

    // (Opcional) Si cambian el archivo manualmente, puedes actualizar el nombre / ícono dinámicamente
    fileInput.addEventListener('change', function (evt) {
        const file = evt.target.files[0];
        if (!file) return;
        const filename = file.name;
        // actualizar nombre
        const nombreSpan = document.getElementById('nombre-archivo');
        if (nombreSpan) nombreSpan.textContent = filename;
        // actualizar ícono (puedes replicar la lógica de extensión)
        const ext = filename.split('.').pop().toLowerCase();
        const iconoSpan = document.getElementById('icono-archivo');
        if (iconoSpan) {
            // limpiar contenido
            iconoSpan.innerHTML = '';
            let html = '';
            switch (ext) {
                case 'pdf':
                    html = `<i class="fa fa-file-pdf-o" style="color: red;"></i>`;
                    break;
                case 'docx':
                case 'doc':
                    html = `<i class="fa fa-file-word-o" style="color: blue;"></i>`;
                    break;
                case 'xlsx':
                case 'xls':
                    html = `<i class="fa fa-file-excel-o" style="color: green;"></i>`;
                    break;
                case 'png':
                case 'jpg':
                case 'jpeg':
                    html = `<i class="fa fa-file-image-o" style="color: orange;"></i>`;
                    break;
                default:
                    html = `<i class="fa fa-file-o"></i>`;
            }
            iconoSpan.innerHTML = html;
        }
    });
});




//Validacion de los datos en tiempo real antes de enviar el formulario
(function () {
  const form = document.querySelector('form[action="agregarDocumento"]');
  if (!form) return;

  // helpers de UI
  function clearError(el) {
    if (!el) return;
    el.classList.remove('is-invalid');
    const next = el.nextElementSibling;
    if (next && next.classList && next.classList.contains('invalid-feedback-js')) next.remove();
  }

  function setError(el, message) {
    if (!el) return;
    clearError(el);
    el.classList.add('is-invalid');
    const msg = document.createElement('div');
    msg.className = 'invalid-feedback-js';
    msg.textContent = message;
    el.insertAdjacentElement('afterend', msg);
  }

  // validadores
  function validateDateFormat(value) {
    if (!value) return false;
    if (!/^\d{4}-\d{2}-\d{2}$/.test(value)) return false;
    const d = new Date(value + 'T00:00:00');
    return !isNaN(d.getTime());
  }

  function validateInteger(value) {
    if (value === undefined || value === null) return false;
    value = String(value).trim();
    if (!/^\d+$/.test(value)) return false;
    if (value.length > 1 && value.charAt(0) === '0') return false;
    if (parseInt(value, 10) === 0) return false;
    return true;
  }



  function validateField(field) {
    if (!field) return true;
    const name = field.name;
    const val = field.value;


    clearError(field);

    switch (name) {
      case 'idProceso':
      case 'idTipoDocumento':
        if (!val || !validateInteger(val)) {
          setError(field, 'Seleccione una opción válida.');
          return false;
        }
        return true;

      case 'consecutivo':
        if (!val || !val.trim()) {
          setError(field, 'El consecutivo es requerido.');
          return false;
        }
        if (val.trim().length > 10) {
          setError(field, 'Máximo 5 caracteres.');
          return false;
        }
        return true;

      case 'nombreDocumento':
        if (!val || !val.trim()) {
          setError(field, 'El nombre del documento es requerido.');
          return false;
        }
        if (val.trim().length > 200) {
          setError(field, 'Máximo 200 caracteres.');
          return false;
        }
        return true;

      case 'fechaCreacion':
      case 'fechaVersion':
      case 'fechaRevision':
        if (!val) {
          setError(field, 'La fecha es requerida.');
          return false;
        }
        if (!validateDateFormat(val)) {
          setError(field, 'Formato de fecha inválido (YYYY-MM-DD).');
          return false;
        }
        return true;

      case 'numeroVersion':
      case 'numeroRevision':
        if (!val || !val.trim()) {
          setError(field, 'Este número es requerido.');
          return false;
        }
        if (!validateInteger(val)) {
          setError(field, 'Ingrese un número entero válido (sin ceros a la izquierda, no 0).');
          return false;
        }
        return true;

      case 'responsable':
        if (!val || !val.trim()) {
          setError(field, 'Seleccione un responsable.');
          return false;
        }
        return true;

      case 'v_Actualizada':
        if (val && val.trim() !== '') {
          if (!validateInteger(val)) {
            setError(field, 'La versión actualizada debe ser un número entero válido.');
            return false;
          }
        }
        return true;

      case 'numeral':
        if (val && val.trim() !== '' && val.trim().length > 20) {
          setError(field, 'Máximo 20 caracteres para numeral.');
          return false;
        }
        return true;

      case 'observaciones':
        if (val && val.trim().length > 1500) {
          setError(field, 'Máximo 1500 caracteres en observaciones.');
          return false;
        }
        return true;



      default:
      
        return true;
    }
  }






  function validateForm() {
    let ok = true;
    const campos = [
      'idProceso', 'idTipoDocumento', 'consecutivo', 'nombreDocumento',
      'fechaCreacion', 'fechaVersion', 'numeroVersion', 'fechaRevision', 'numeroRevision',
      'responsable', 'v_Actualizada', 'numeral', 'observaciones', 'archivo'
    ];
    for (const name of campos) {
      const el = form.querySelector('[name="' + name + '"]');
      const res = validateField(el);
      if (!res) ok = false;
    }
    return ok;
  }

  // ACTUALIZACION DE ESTADO DEL BOTÓN SUBMIT
  function updateSubmitState() {
    const submitBtn = form.querySelector('[type="submit"], .btn-submit');
    if (!submitBtn) return;
    const ok = validateForm();
    submitBtn.disabled = !ok;
  }

  //Listeners que escuchan cambios en los campos para validar en tiempo real

  const watchSelectors = 'input[name], textarea[name], select[name]';
  const watchables = form.querySelectorAll(watchSelectors);
  watchables.forEach(el => {

    if (el.tagName.toLowerCase() === 'select') {
      el.addEventListener('change', function () {
        validateField(el);
        updateSubmitState();
      });
    } else {
      el.addEventListener('input', function () {
        validateField(el);
        updateSubmitState();
      });
      el.addEventListener('change', function () {
        validateField(el);
        updateSubmitState();
      });
    }
  });

  //Prevenir envío si falla validación

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const ok = validateForm();
    if (!ok) {
      const firstInvalid = form.querySelector('.is-invalid');
      if (firstInvalid) firstInvalid.focus();
      return false;
    }


    //Se envia el formulario si pasa la validación
    form.submit();
    return true;
  });

  //Inicial: Se actualizar botón (por si hay valores cargados)
  updateSubmitState();

})();




//Contador de caracteres para campo "observaciones" en tiempo real.
(function () {
  const ta = document.querySelector('[name="observaciones"]');
  if (!ta) return;

  let counter = document.getElementById('observacionesCount');
  if (!counter) {
    const wrap = document.createElement('div');
    wrap.className = 'd-flex justify-content-end mt-1';
    counter = document.createElement('small');
    counter.id = 'observacionesCount';
    counter.setAttribute('aria-live', 'polite');
    counter.textContent = '0/1500';
    wrap.appendChild(counter);
    ta.insertAdjacentElement('afterend', wrap);
    counter = document.getElementById('observacionesCount');
  }

  const MAX = 1500;

  function updateCounter() {
    const len = ta.value.length; 
    counter.textContent = `${len}/${MAX}`;
    if (len > MAX) {
      counter.classList.add('exceeded');
      
      ta.classList.add('is-invalid');

      const next = ta.nextElementSibling;
      if (!(next && next.classList && next.classList.contains('invalid-feedback-js'))) {
        const msg = document.createElement('div');
        msg.className = 'invalid-feedback-js';
        msg.textContent = `Máximo ${MAX} caracteres.`;
        ta.insertAdjacentElement('afterend', msg);
      }
    } else {
      counter.classList.remove('exceeded');
    
      ta.classList.remove('is-invalid');
      const next = ta.nextElementSibling;
      if (next && next.classList && next.classList.contains('invalid-feedback-js')) next.remove();
    }


    if (typeof validateField === 'function') {
      try { validateField(ta); } catch (err) { /* silent */ }
    }
    if (typeof updateSubmitState === 'function') {
      try { updateSubmitState(); } catch (err) { /* silent */ }
    }
  }


  ta.addEventListener('input', updateCounter);


  updateCounter();
})();