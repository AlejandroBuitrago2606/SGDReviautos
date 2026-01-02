<div class="modal fade" id="perfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="perfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 16px;">
            <form method="POST" action="{{ url('/editarUsuario') }}" id="formEditarUsuario">
                @csrf
                @method('PATCH')

                @php
                $user = Auth::user();
                @endphp

                @if (!isset($lista_roles) || !isset($user))

                <div class="alert alert-danger m-3" role="alert">
                    Error al cargar los datos. Por favor, intente recargando la pagina nuevamente.
                </div>

                @endif
                <input type="hidden" id="idUsuarioEdit" name="idUsuarioEdit" value="{{ $user->id }}" />

                <div class="modal-header border-0 pb-0" style="padding: 24px 24px 0;">
                    <div>
                        <h1 class="modal-title fs-4 fw-bold mb-1" style="color: #1c1d27ff;" id="perfilLabel">Editar Perfil</h1>
                        <p class="text-muted small mb-0">Modifica tu información de usuario</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="padding: 24px;">
                    <div class="mb-3">
                        <label for="nombreUsuarioEdit" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                            </svg>
                            Nombre Completo
                        </label>
                        <input type="text"
                            value="{{ $user->nombreUsuario }}"
                            class="form-control"
                            name="nombreUsuarioEdit"
                            id="nombreUsuarioEdit"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            placeholder="Ingrese el nombre completo"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="telefonoEdit" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                            </svg>
                            Teléfono
                        </label>
                        <input type="text"
                            value="{{ $user->telefono }}"
                            class="form-control"
                            name="telefonoEdit"
                            id="telefonoEdit"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            placeholder="Ingrese el número de teléfono"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="correoEdit" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                            </svg>
                            Correo Electrónico
                        </label>
                        <input type="email"
                            value="{{ $user->email }}"
                            class="form-control"
                            name="correoEdit"
                            id="correoEdit"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            placeholder="ejemplo@correo.com"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="claveEdit" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M12 17a2 2 0 0 0 2-2a2 2 0 0 0-2-2a2 2 0 0 0-2 2a2 2 0 0 0 2 2m6-9a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1V6a5 5 0 0 1 5-5a5 5 0 0 1 5 5v2zm-6-5a3 3 0 0 0-3 3v2h6V6a3 3 0 0 0-3-3" />
                            </svg>
                            Nueva Contraseña
                        </label>
                        <input type="password"
                            class="form-control"
                            name="claveEdit"
                            minlength="8"
                            id="claveEdit"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            placeholder="Ingrese nueva contraseña"
                            required />
                        <small class="text-muted">Ingrese una nueva contraseña para actualizar</small>
                    </div>

                    <div class="mb-3">
                        <label for="idRolEdit" class="form-label fw-medium" style="color: #495057; font-size: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="me-1" style="vertical-align: text-bottom;">
                                <path fill="currentColor" d="M12 12.75c1.63 0 3.07.39 4.24.9c1.08.48 1.76 1.56 1.76 2.73V18H6v-1.61c0-1.18.68-2.26 1.76-2.73c1.17-.52 2.61-.91 4.24-.91M4 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2m1.13 1.1c-.37-.06-.74-.1-1.13-.1c-.99 0-1.93.21-2.78.58A2.01 2.01 0 0 0 0 16.43V18h4.5v-1.61c0-.83.23-1.61.63-2.29M20 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2m4 3.43c0-.81-.48-1.53-1.22-1.85A6.95 6.95 0 0 0 20 14c-.39 0-.76.04-1.13.1c.4.68.63 1.46.63 2.29V18H24zM12 6c1.66 0 3 1.34 3 3s-1.34 3-3 3s-3-1.34-3-3s1.34-3 3-3" />
                            </svg>
                            Rol del Usuario
                        </label>




                        <select class="form-select"
                            name="idRolEdit"
                            id="idRolEdit"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px;"
                            required>

                            <option value="{{ $user->idRol }}" selected>
                                {{ $lista_roles->firstWhere('id', $user->idRol)->nombreRol }}
                            </option>


                        </select>
                        @if ($user->idRol != 4)
                        <em class="text-center">Este ajuste lo cambia el administrador</em>😊
                        @endif



                    </div>

                    @if(isset($usuarioEditado))
                    <script>
                        setTimeout(() => {
                            const msg = @json($usuarioEditado);
                            alert(msg);
                        }, 0.05);
                        window.location.href = "/dashboard";
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
                            <path fill="white" d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                        </svg>
                        <span class="fw-semibold">Guardar Cambios</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>