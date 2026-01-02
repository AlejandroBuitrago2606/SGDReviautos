// Obtener los campos de contraseña
const passwordField = document.getElementById('password');
const confirmPasswordField = document.getElementById('password_confirmation');
const submitButton = document.querySelector('button[type="submit"]');

// Crear elemento para mostrar mensajes
const messageDiv = document.createElement('div');
messageDiv.style.marginTop = '8px';
messageDiv.style.fontSize = '14px';
messageDiv.style.fontWeight = '500';
confirmPasswordField.parentElement.appendChild(messageDiv);

// Función para validar las contraseñas
function validatePasswords() {
    const password = passwordField.value;
    const confirmPassword = confirmPasswordField.value;
    
    // Si el campo de confirmación está vacío, no mostrar nada
    if (confirmPassword === '') {
        messageDiv.textContent = '';
        messageDiv.className = '';
        confirmPasswordField.style.borderColor = '#dee2e6';
        submitButton.disabled = false;
        return;
    }
    
    // Verificar si las contraseñas coinciden
    if (password === confirmPassword) {
        messageDiv.textContent = '✓ Las contraseñas coinciden';
        messageDiv.style.color = '#10b981';
        confirmPasswordField.style.borderColor = '#10b981';
        submitButton.disabled = false;
    } else {
        messageDiv.textContent = '✗ Las contraseñas no coinciden';
        messageDiv.style.color = '#ef4444';
        confirmPasswordField.style.borderColor = '#ef4444';
        submitButton.disabled = true;
    }
}

// Validar también la longitud mínima
function validatePasswordLength() {
    const password = passwordField.value;
    
    if (password.length > 0 && password.length < 8) {
        passwordField.style.borderColor = '#ef4444';
    } else if (password.length >= 8) {
        passwordField.style.borderColor = '#10b981';
    } else {
        passwordField.style.borderColor = '#dee2e6';
    }
    
    // Validar coincidencia cuando cambie la contraseña principal
    validatePasswords();
}

// Agregar eventos para validación en tiempo real
passwordField.addEventListener('input', validatePasswordLength);
confirmPasswordField.addEventListener('input', validatePasswords);

// Validación adicional al enviar el formulario
document.querySelector('form').addEventListener('submit', function(e) {
    const password = passwordField.value;
    const confirmPassword = confirmPasswordField.value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Las contraseñas no coinciden. Por favor, verifica que ambas contraseñas sean iguales.');
        return false;
    }
    
    if (password.length < 8) {
        e.preventDefault();
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false;
    }
});