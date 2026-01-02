<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SG Reviautos</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/resetPassword.css') }}">

</head>

<body>


    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); max-width: 500px; width: 100%;">
            <div class="card-body" style="padding: 32px;">
                <div class="mb-4">
                    <h1 class="fs-3 fw-bold mb-1" style="color: #1c1d27ff;">Restablecer contraseña</h1>
                    <p class="text-muted small mb-0">Ingresa tu nueva contraseña</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token ?? '' }}">

                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                            </svg>
                            Correo Electrónico
                        </label>
                        <input type="email"
                            class="form-control"
                            name="email"
                            id="email"
                            value="{{ request('email') }}"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px; background-color: #f8f9fa;"
                            placeholder="ejemplo@correo.com"
                            readonly />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
                            </svg>
                            Nueva Contraseña
                        </label>
                        <input type="password"
                            class="form-control"
                            name="password"
                            id="password"
                            minlength="8"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            placeholder="Ingresa tu nueva contraseña"
                            required />
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
                            </svg>
                            Confirmar Contraseña
                        </label>
                        <input type="password"
                            class="form-control"
                            name="password_confirmation"
                            minlength="8"
                            id="password_confirmation"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            placeholder="Confirma tu nueva contraseña"
                            required />
                    </div>

                    <button type="submit"
                        class="btn w-100 py-2 d-flex align-items-center justify-content-center gap-2"
                        style="background-color: #10b981; border: none; color: white; border-radius: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="white" d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                        </svg>
                        <span class="fw-semibold">Restablecer contraseña</span>
                    </button>
                </form>
            </div>
        </div>
    </div>


    @if(isset($resetPassword))
    <script>
        setTimeout(() => {
            alert('Contraseña restablecida con éxito. Por favor, inicia sesión con tu nueva contraseña.');
        }, 0.03);
        window.location.href = "/";
    </script>
    @else

    <!-- No hacer nada -->

    @endif
    <script src="{{ asset('/js/resetPassword.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>