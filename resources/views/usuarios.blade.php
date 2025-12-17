@extends('masterpages.dashboard')


@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Usuarios</h2>
    <br>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Agregar Usuario
    </button>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Clave</th>
                <th>Rol</th>
                <th>Acciones</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (!isset($usuarios) and !isset($roles))
            <tr>
                <td colspan="5">No hay usuarios disponibles.</td>
            </tr>
            @endif


            @foreach($usuarios as $usuario)


            @if ($usuario->idRol != 4 )

            {{-- FILA NORMAL --}}
            <tr id="filaVista{{ $usuario->id }}">
                <td>{{ $usuario->nombreUsuario }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>******</td>
                <td>{{ $roles->firstWhere('id', $usuario->idRol)->nombreRol ?? 'Sin rol' }}</td>
                <td>
                    <button class="btn btn-primary btn-sm"
                        onclick="mostrarEditar({{ $usuario->id }})">
                        Editar
                    </button>
                </td>
                <td><button class="btn btn-danger btn-sm">Eliminar</button></td>
            </tr>

            {{-- FILA EDICIÓN --}}
            <tr id="filaEditar{{ $usuario->id }}" style="display:none; background:#f9f9f9;">
                <td colspan="6">

                    <form action="{{ url('/editarUsuario') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row align-items-end">

                            <input type="hidden" id="idUsuarioEdit" name="idUsuarioEdit" value="{{ $usuario->id }}" />

                            <div class="col-md-3 mb-2">
                                <label>Nombre</label>
                                <input type="text" id="nombreUsuarioEdit" name="nombreUsuarioEdit"
                                    class="form-control"
                                    value="{{ $usuario->nombreUsuario }}" required />
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Teléfono</label>
                                <input type="number" id="telefonoEdit" name="telefonoEdit"
                                    class="form-control"
                                    value="{{ $usuario->telefono }}" required />
                            </div>

                            <div class="col-md-3 mb-2">
                                <label>Correo</label>
                                <input type="email" id="correoEdit" name="correoEdit"
                                    class="form-control"
                                    value="{{ $usuario->correo }}" required />
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Clave</label>
                                <input type="text" id="claveEdit" name="claveEdit"
                                    class="form-control"
                                    required />
                            </div>


                            <div class="col-md-2 mb-2">
                                <label>Rol</label>
                                <select id="idRolEdit" name="idRolEdit" class="form-select">
                                    @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}"
                                        {{ $usuario->idRol == $rol->id ? 'selected' : '' }}>
                                        {{ $rol->nombreRol }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <button class="btn btn-success btn-sm w-100">
                                    Guardar
                                </button>
                                <button type="button"
                                    class="btn btn-secondary btn-sm w-100 mt-1"
                                    onclick="cancelarEditar({{ $usuario->id }})">
                                    Cancelar
                                </button>
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





<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form method="POST" action="{{ url('/agregarUsuario') }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <div class="mb-3">
                        <label for="nombreUsuario" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required />
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="col-form-label">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" required />
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="col-form-label">Correo:</label>
                        <input type="email" class="form-control" name="correo" id="correo" required />
                    </div>
                    <div class="mb-3">
                        <label for="clave" class="col-form-label">Clave:</label>
                        <input type="text" value="1234" class="form-control disable" name="clave" id="clave" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="col-form-label">Rol:</label>
                        <select class="form-select" name="idRol" id="rol" required>
                            @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nombreRol }}</option>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success">Registrar</button>
                </div>
            </div>
        </div>

    </form>

</div>




<script src="{{ asset('/js/usuarios.js') }}"></script>
@endsection