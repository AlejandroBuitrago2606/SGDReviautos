@extends('masterpages.dashboard')


@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Lista de Usuarios</h2>
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
                <td><button class="btn btn-danger btn-sm" >Eliminar</button></td>
            </tr>

            {{-- FILA EDICIÓN --}}
            <tr id="filaEditar{{ $usuario->id }}" style="display:none; background:#f9f9f9;">
                <td colspan="6">

                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row align-items-end">

                            <div class="col-md-3 mb-2">
                                <label>Nombre</label>
                                <input type="text" name="nombreUsuario"
                                    class="form-control"
                                    value="{{ $usuario->nombreUsuario }}" required>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Teléfono</label>
                                <input type="number" name="telefono"
                                    class="form-control"
                                    value="{{ $usuario->telefono }}" required>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label>Correo</label>
                                <input type="email" name="correo"
                                    class="form-control"
                                    value="{{ $usuario->correo }}" required>
                            </div>

                            <div class="col-md-2 mb-2">
                                <label>Rol</label>
                                <select name="idRol" class="form-select">
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
                    </form>

                </td>
            </tr>

            @endif

            @endforeach

        </tbody>
    </table>
</div>

<script>
    function mostrarEditar(id) {
        document.getElementById('filaVista' + id).style.display = 'none';
        document.getElementById('filaEditar' + id).style.display = '';
    }

    function cancelarEditar(id) {
        document.getElementById('filaVista' + id).style.display = '';
        document.getElementById('filaEditar' + id).style.display = 'none';
    }
</script>
@endsection