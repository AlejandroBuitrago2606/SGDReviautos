<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Reviautos</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="login-page">
        <div class="form-container">
            <!-- Logo y Título -->
            <div class="logo-container">
                <div class="logo-icon">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="#ffffffff" d="M6 22q-.825 0-1.412-.587T4 20V10q0-.825.588-1.412T6 8h1V6q0-2.075 1.463-3.537T12 1t3.538 1.463T17 6v2h1q.825 0 1.413.588T20 10v10q0 .825-.587 1.413T18 22zm6-5q.825 0 1.413-.587T14 15t-.587-1.412T12 13t-1.412.588T10 15t.588 1.413T12 17M9 8h6V6q0-1.25-.875-2.125T12 3t-2.125.875T9 6z" />
                    </svg> -->

                    <image src="{{ asset('/images/logoReviautos_sol_3.png') }}" alt="Logo Reviautos" width="80" height="40" />

                </div>
                <h1 class="form-title">Iniciar Sesión</h1>
                <p class="form-subtitle">Accede al Sistema de Gestión Documental</p>
            </div>

            <!-- Formulario de Login -->
            <form class="login-form" action="{{ url('/login') }}" method="POST">
                @csrf

                <!-- Campo Email -->
                <div class="input-group">
                    <input type="email" name="email" placeholder="Correo electrónico" required />
                    <svg class="input-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                    </svg>
                </div>

                <!-- Campo Password -->
                <div class="input-group">
                    <input type="password" name="password" placeholder="Contraseña" required />
                    <svg class="input-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
                    </svg>
                </div>

                <!-- Botón de Login -->
                <button type="submit">Iniciar Sesión</button>

                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdropAddUser" class="create-account">Registrate</a>

                <!-- Mensaje de Error -->
                @if (session('error'))
                <div class="alert alert-danger">
                    ⚠️ {{ session('error') }}
                </div>
                @endif
            </form>

            <!-- Footer del Formulario -->
            <div class="form-footer">
                <p>CDA REVIAUTOS S.A. © 2025</p>
            </div>



            <!-- @if(isset($correoExiste)) -->

            <div id="mensaje-restablecimiento" class="mensaje-restablecimiento">
                @switch($correoExiste)
                @case("success")
                ✔️ Se ha enviado un enlace de restablecimiento de contraseña a tu correo electrónico.
                @break

                @case("error")
                ❌ Error al restablecer la contraseña. Por favor, intenta nuevamente.
                @break

                @case("null")
                ❌ El correo electrónico no está registrado en el sistema.
                @break

                @case("claveActualizada")
                ✔️ Tu contraseña ha sido actualizada exitosamente.
                @default
                <!-- No hacer nada -->
                @endswitch
            </div>

            <script>

            </script>
<!-- 
            @endif -->

        </div>
    </div>

    <div class="modal fade" id="staticBackdropAddUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropAddUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: none; border-radius: 16px;">
                <form method="POST" action="{{ url('/agregarUsuario') }}">
                    <div class="modal-header border-0 pb-0" style="padding: 24px 24px 0;">
                        <div>
                            <h1 class="modal-title fs-4 fw-bold mb-1" style="color: #1c1d27ff;" id="staticBackdropAddUserLabel">Registrate</h1>
                            <p class="text-muted small mb-0">Completa la siguiente información</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" style="padding: 24px;">
                        @csrf

                        <div class="mb-3">
                            <label for="nombreUsuario" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                    <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                                </svg>
                                Nombre Completo
                            </label>
                            <input type="text"
                                class="form-control"
                                name="nombreUsuario"
                                id="nombreUsuario"
                                style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                                placeholder="Ingrese el nombre completo"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                    <path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                                </svg>
                                Teléfono
                            </label>
                            <input type="text"
                                class="form-control"
                                name="telefono"
                                id="telefono"
                                style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                                placeholder="Ingrese el número de teléfono"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                    <path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                                </svg>
                                Correo Electrónico
                            </label>
                            <input type="email"
                                class="form-control"
                                name="correo"
                                id="correo"
                                style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                                placeholder="ejemplo@correo.com"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="clave" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                    <path fill="currentColor" d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
                                </svg>
                                Contraseña
                            </label>
                            <input type="password"
                                class="form-control"
                                name="clave"
                                id="clave"
                                style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;" />
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                    <path fill="currentColor" d="M12 12.75c1.63 0 3.07.39 4.24.9c1.08.48 1.76 1.56 1.76 2.73V18H6v-1.61c0-1.18.68-2.26 1.76-2.73c1.17-.52 2.61-.91 4.24-.91M4 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2m1.13 1.1c-.37-.06-.74-.1-1.13-.1c-.99 0-1.93.21-2.78.58A2.01 2.01 0 0 0 0 16.43V18h4.5v-1.61c0-.83.23-1.61.63-2.29M20 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2m4 3.43c0-.81-.48-1.53-1.22-1.85A6.95 6.95 0 0 0 20 14c-.39 0-.76.04-1.13.1c.4.68.63 1.46.63 2.29V18H24zM12 6c1.66 0 3 1.34 3 3s-1.34 3-3 3s-3-1.34-3-3s1.34-3 3-3" />
                                </svg>
                                Rol del Usuario
                            </label>
                            <select class="form-select"
                                name="idRol"
                                id="rol"
                                style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                                required>
                                <option value="6" selected>Indefinido</option>
                            </select>
                        </div>

                        @if(isset($usuarioCreado))
                        <script>
                            setTimeout(() => {
                                const msg = @json($usuarioCreado);
                                alert(msg);
                            }, 0.05);
                            window.location.href = "/";
                        </script>
                        @endif
                    </div>

                    <div class="modal-footer border-0" style="padding: 0 24px 24px;">
                        <button type="button"
                            class="btn px-4 py-2"
                            style="background-color: #f8f9fa; border: 1px solid #dee2e6; color: #495057; border-radius: 8px;"
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="btn px-4 py-2 d-flex align-items-center gap-2"
                            style="background-color: #10b981; border: none; color: white; border-radius: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                <path fill="white" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                            </svg>
                            <span class="fw-semibold">Continuar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('auth.forgotPassword')

     <script src="{{ asset('js/login.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>