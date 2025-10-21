@extends('masterpages.dashboard')


@section('content')


<link rel="stylesheet" type="text/css" href="{{ asset('/css/agregarDocumento.css') }}">

<h1 class="text-center">Agregar Documento</h1>

<form action="agregarDocumento" method="POST" class="p-1" enctype="multipart/form-data">
    @csrf

    @if (!isset($datos[0]) and !isset($datos[1]) and !isset($datos[2]) )    
    <script>
        setTimeout(() => {
            const msg = "No se han cargado los datos";
            alert(msg);
        }, 0.05);
    </script>
    @endif

    <style></style>

    <!-- Identificacion del documento -->
    <div class="form-section">
        <h3 class="text-center">Identificación del Documento</h3>



        <div class="row">
            <div class="col-lg-3 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Proceso
                </label>
                <select name="idProceso" class="form-control" id="idProceso" required>
                    @foreach ($datos[0] as $proceso)
                    <option value="{{ $proceso->idProceso }}">{{ $proceso->nombreProceso.' - ' . $proceso->prefijo}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Tipo de Documento
                </label>
                <select name="idTipoDocumento" class="form-control" id="idTipoDocumento" required>
                    @foreach ($datos[1] as $tp)
                    <option value="{{ $tp->idTipoDocumento }}">{{ $tp->nombreDocumento.' - ' . $tp->prefijo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>N° de Consecutivo
                </label>
                <input type="text" id="consecutivo" class="form-control" name="consecutivo" placeholder="Ej: 01, 02" required />
                @error('consecutivo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-3 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Nombre del Documento
                </label>
                <input type="text" id="nombreDocumento" class="form-control" name="nombreDocumento" placeholder="Ingrese el nombre" required />
                @error('nombreDocumento')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Control de version -->
    <div class="form-section">
        <h3 class="text-center">Control de Versión</h3>

        <div class="row">
            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Fecha de Creación
                </label>
                <input type="date" id="fechaCreacion" class="form-control" name="fechaCreacion" required />
                @error('fechaCreacion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Fecha de Versión
                </label>
                <input type="date" id="fechaVersion" class="form-control" name="fechaVersion" required />
                @error('fechaVersion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Número de Versión
                </label>
                <input type="number" placeholder="1, 2, 3..." id="numeroVersion" class="form-control" name="numeroVersion" min="1" required />
                @error('numeroVersion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Fecha de Revisión
                </label>
                <input type="date" id="fechaRevision" class="form-control" name="fechaRevision" required />
                @error('fechaRevision')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Número de Revisión
                </label>
                <input type="number" id="numeroRevision" class="form-control" name="numeroRevision" placeholder="Ingrese número" min="1" required />
                @error('numeroRevision')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Responsable
                </label>
                <select name="responsable" class="form-control" id="responsable" required>
                    @foreach ($datos[2] as $rol)
                    <option value="{{ $rol->idRol }}">{{ $rol->nombreRol}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Control de cambios -->
    <div class="form-section">
        <h3 class="text-center">Control de Cambios</h3>

        <div class="row">
            <div class="col-lg-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Número de Versión Actualizada
                </label>
                <input type="number" id="v_Actualizada" class="form-control" name="v_Actualizada" placeholder="Ingrese versión" min="1" />
            </div>

            <div class="col-lg-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Numeral
                </label>
                <input type="text" id="numeral" class="form-control" name="numeral" placeholder="Ej: 4.1.2" />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Adjuntar Documento
                </label>
                <input type="file" id="archivo" name="archivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" required />
                <p id="msg" class="text-center">Formatos permitidos: PDF, Word, Excel, Imágenes (JPG, PNG)</p>
                @error('archivo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Observaciones
                </label>
                <textarea name="observaciones" id="observaciones" class="form-control" cols="30" rows="8" placeholder="Ingrese observaciones adicionales..."></textarea>
            </div>
        </div>
    </div>

    <!-- Botón de envío -->
    <button type="submit" class="btn-submit">
        💾 Guardar Documento
    </button>

    <!-- Recibir el mensaje y mostrarlo en un alert y luego redirigir a otra page -->
    @if(isset($documentoCreado))
    <script>
        setTimeout(() => {
            const msg = @json($documentoCreado);
            alert(msg);
        }, 0.05);
        window.location.href = "/indexDocumentos";
    </script>
    @endif

</form>
<script src="{{ asset('/js/style.js') }}"></script>



@endsection