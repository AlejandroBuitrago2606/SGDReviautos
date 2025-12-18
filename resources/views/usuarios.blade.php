@extends('masterpages.dashboard')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #1c1d27ff;">Gestión de Usuarios</h2>
            <p class="text-muted mb-0">Administra los usuarios del sistema</p>
        </div>
        <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"
            style="background-color: #1c1d27ff; border: none; border-radius: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path fill="white" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
            </svg>
            <span class="fw-semibold">Agregar Usuario</span>
        </button>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="min-width: 800px;">
                    <thead style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="py-3 px-4 fw-semibold" style="color: #1c1d27ff;">Nombre</th>
                            <th class="py-3 px-4 fw-semibold" style="color: #1c1d27ff;">Teléfono</th>
                            <th class="py-3 px-4 fw-semibold" style="color: #1c1d27ff;">Correo Electrónico</th>
                            <th class="py-3 px-4 fw-semibold" style="color: #1c1d27ff;">Contraseña</th>
                            <th class="py-3 px-4 fw-semibold" style="color: #1c1d27ff;">Rol</th>
                            <th class="py-3 px-4 fw-semibold text-center" style="color: #1c1d27ff;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!isset($usuarios) and !isset($roles))
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" class="mb-3 opacity-50">
                                    <path fill="#6c757d" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                                <p class="text-muted mb-0">No hay usuarios disponibles.</p>
                            </td>
                        </tr>
                        @endif

                        @foreach($usuarios as $usuario)
                        @if ($usuario->idRol != 4)

                        {{-- FILA NORMAL --}}
                        <tr id="filaVista{{ $usuario->id }}" style="border-bottom: 1px solid #f1f3f5;">
                            <td class="py-3 px-4 align-middle">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar-small d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; color: white; font-weight: 600;">
                                        {{ strtoupper(substr($usuario->nombreUsuario, 0, 1)) }}
                                    </div>
                                    <span class="fw-medium" style="color: #1c1d27ff;">{{ $usuario->nombreUsuario }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 align-middle">
                                <span class="text-muted">{{ $usuario->telefono }}</span>
                            </td>
                            <td class="py-3 px-4 align-middle">
                                <span class="text-muted">{{ $usuario->correo }}</span>
                            </td>
                            <td class="py-3 px-4 align-middle">
                                <span class="badge bg-light text-dark px-3 py-2" style="font-family: monospace; letter-spacing: 2px;">••••••</span>
                            </td>
                            <td class="py-3 px-4 align-middle">
                                <span class="badge px-3 py-2" style="background-color: #e3f2fd; color: #1976d2; border-radius: 6px;">
                                    {{ $roles->firstWhere('id', $usuario->idRol)->nombreRol ?? 'Sin rol' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm d-flex align-items-center gap-1 px-3"
                                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 6px; color: #495057;"
                                        onclick="mostrarEditar('{{ $usuario->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75z" />
                                        </svg>
                                        <span class="fw-medium">Editar</span>
                                    </button>

                                    <form action="{{ url('eliminarUsuario/'.$usuario->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm d-flex align-items-center gap-1 px-3"
                                            style="background-color: #fff5f5; border: 1px solid #feb2b2; border-radius: 6px; color: #c53030;"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6zM19 4h-3.5l-1-1h-5l-1 1H5v2h14z" />
                                            </svg>
                                            <span class="fw-medium">Eliminar</span>
                                        </button>

                                        @if(isset($usuarioEliminado))
                                        <script>
                                            setTimeout(() => {
                                                const msg = @json($usuarioEliminado);
                                                alert(msg);
                                            }, 0.05);
                                            window.location.href = "/usuarios";
                                        </script>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- FILA EDICIÓN --}}
                        <tr id="filaEditar{{ $usuario->id }}" style="display:none; background:#f8f9fa;">
                            <td colspan="6" class="py-4 px-4">
                                <form action="{{ url('/editarUsuario') }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" id="idUsuarioEdit" name="idUsuarioEdit" value="{{ $usuario->id }}" />

                                    <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                                        <div class="card-body p-4">
                                            <h6 class="fw-bold mb-3" style="color: #1c1d27ff;">Editar Usuario</h6>

                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label fw-medium" style="color: #495057; font-size: 14px;">Nombre Completo</label>
                                                    <input type="text"
                                                        id="nombreUsuarioEdit"
                                                        name="nombreUsuarioEdit"
                                                        class="form-control"
                                                        style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 14px;"
                                                        value="{{ $usuario->nombreUsuario }}"
                                                        required />
                                                </div>

                                                <div class="col-md-2">
                                                    <label class="form-label fw-medium" style="color: #495057; font-size: 14px;">Teléfono</label>
                                                    <input type="number"
                                                        id="telefonoEdit"
                                                        name="telefonoEdit"
                                                        class="form-control"
                                                        style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 14px;"
                                                        value="{{ $usuario->telefono }}"
                                                        required />
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label fw-medium" style="color: #495057; font-size: 14px;">Correo Electrónico</label>
                                                    <input type="email"
                                                        id="correoEdit"
                                                        name="correoEdit"
                                                        class="form-control"
                                                        style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 14px;"
                                                        value="{{ $usuario->correo }}"
                                                        required />
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label fw-medium" style="color: #495057; font-size: 14px;">Nueva Contraseña</label>
                                                    <input type="text"
                                                        id="claveEdit"
                                                        name="claveEdit"
                                                        class="form-control"
                                                        style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 14px;"
                                                        placeholder="Ingrese nueva contraseña"
                                                        required />
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label fw-medium" style="color: #495057; font-size: 14px;">Rol</label>
                                                    <select id="idRolEdit"
                                                        name="idRolEdit"
                                                        class="form-select"
                                                        style="border-radius: 8px; border: 1px solid #dee2e6; padding: 10px 14px;">
                                                        @foreach($roles as $rol)

                                                        @if ($rol->id != 4)
                                                            <option value="{{ $rol->id }}" {{ $usuario->idRol == $rol->id ? 'selected' : '' }}>
                                                                {{ $rol->nombreRol }}
                                                            </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-9 d-flex align-items-end gap-2">
                                                    <button type="submit" class="btn d-flex align-items-center gap-2 px-4"
                                                        style="background-color: #10b981; border: none; color: white; border-radius: 8px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                            <path fill="white" d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                                        </svg>
                                                        <span class="fw-semibold">Guardar Cambios</span>
                                                    </button>

                                                    <button type="button"
                                                        class="btn d-flex align-items-center gap-2 px-4"
                                                        style="background-color: #6c757d; border: none; color: white; border-radius: 8px;"
                                                        onclick="cancelarEditar({{ $usuario->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                            <path fill="white" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                                        </svg>
                                                        <span class="fw-semibold">Cancelar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if(isset($usuarioEditado))
                                    <script>
                                        setTimeout(() => {
                                            const msg = @json($usuarioEditado);
                                            alert(msg);
                                        }, 0.05);
                                        window.location.href = "/usuarios";
                                    </script>
                                    @endif
                                </form>
                            </td>
                        </tr>

                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Usuario -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 16px;">
            <form method="POST" action="{{ url('/agregarUsuario') }}">
                <div class="modal-header border-0 pb-0" style="padding: 24px 24px 0;">
                    <div>
                        <h1 class="modal-title fs-4 fw-bold mb-1" style="color: #1c1d27ff;" id="staticBackdropLabel">Agregar Nuevo Usuario</h1>
                        <p class="text-muted small mb-0">Complete la información del usuario</p>
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
                        <input type="text"
                            value="1234"
                            class="form-control"
                            name="clave"
                            id="clave"
                            style="border-radius: 8px; border: 1px solid #dee2e6; padding: 12px 14px; background-color: #f8f9fa;"
                            readonly />
                        <small class="text-muted">Esta contraseña se puede cambiar despues</small>
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
                            <option value="" disabled selected>Seleccione un rol</option>
                            @foreach($roles as $rol)

                            @if ($rol->id != 4)
                            <option value="{{ $rol->id }}">{{ $rol->nombreRol }}</option>
                            @endif

                            @endforeach
                        </select>
                    </div>

                    @if(isset($usuarioCreado))
                    <script>
                        setTimeout(() => {
                            const msg = @json($usuarioCreado);
                            alert(msg);
                        }, 0.05);
                        window.location.href = "/usuarios";
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
                        <span class="fw-semibold">Registrar Usuario</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('/js/usuarios.js') }}"></script>
@endsection