const input = document.getElementById('archivo');
const msg = document.getElementById('msg');

const maxSize = 5 * 1024 * 1024; // Tamaño máximo 5MB
const allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx']; // Extensiones permitidas

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