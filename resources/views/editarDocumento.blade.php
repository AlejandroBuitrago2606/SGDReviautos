@extends('masterpages.dashboard')


@section('content')


<link rel="stylesheet" type="text/css" href="{{ asset('/css/agregarDocumento.css') }}">

<h1 class="text-center">Editar Documento</h1>

<form action="/editarDocumento/{{ $datos[3]->idDocumento }}/edit" method="POST" class="p-1" enctype="multipart/form-data">

    @csrf
    @method('PATCH')


    @if (!isset($datos[0]) and !isset($datos[1]) and !isset($datos[2]) and !isset($datos[3]) )
    <script>
        setTimeout(() => {
            const msg = "No se han cargado los datos";
            alert(msg);
        }, 0.05);
    </script>
    @endif


    <a href="{{ url('indexDocumentos') }}" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <g fill="none">
                <path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                <path fill="currentColor" d="M3.283 10.94a1.5 1.5 0 0 0 0 2.12l5.656 5.658a1.5 1.5 0 1 0 2.122-2.122L7.965 13.5H19.5a1.5 1.5 0 0 0 0-3H7.965l3.096-3.096a1.5 1.5 0 1 0-2.122-2.121z" />
            </g>
        </svg>
        Volver
    </a>



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
                    <option value="{{ $proceso->idProceso }}"
                        @if ($proceso->idProceso === $datos[3]->idProceso) selected @endif>
                        {{ $proceso->nombreProceso . ' - ' . $proceso->prefijo }}
                    </option>
                    @endforeach
                </select>


            </div>

            <div class="col-lg-3 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Tipo de Documento
                </label>

                <select name="idTipoDocumento" class="form-control" id="idTipoDocumento" required>
                    @foreach ($datos[1] as $tp)
                    <option value="{{ $tp->idTipoDocumento }}"
                        @if ($tp->idTipoDocumento === $datos[3]->idTipoDocumento) selected @endif>
                        {{ $tp->nombreDocumento . ' - ' . $tp->prefijo }}
                    </option>
                    @endforeach
                </select>


            </div>



            <div class="col-lg-3 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Nombre del Documento
                </label>
                <input type="text" id="nombreDocumento" class="form-control" name="nombreDocumento" value="{{ $datos[3]->nombre }}" placeholder="Ingrese el nombre" required />
                @error('nombreDocumento')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            <div class="col-lg-3 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>N° de Consecutivo
                </label>
                <input type="text" id="consecutivo" class="form-control" value="{{ $datos[3]->consecutivo }}" name="consecutivo" placeholder="Ej: 01, 02" required />
                @error('consecutivo')
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
                <input type="date" id="fechaCreacion" class="form-control" value="{{ isset($datos[3]->fechaCreacion) ? \Carbon\Carbon::parse($datos[3]->fechaCreacion)->format('Y-m-d') : '' }}" name="fechaCreacion" required />
                @error('fechaCreacion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Fecha de Versión
                </label>
                <input type="date" id="fechaVersion" class="form-control"
                    value="{{ isset($datos[3]->fechaVersion) ? \Carbon\Carbon::parse($datos[3]->fechaVersion)->format('Y-m-d') : '' }}"

                    name="fechaVersion" required />
                @error('fechaVersion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Número de Versión
                </label>
                <input type="number" placeholder="1, 2, 3..." id="numeroVersion" value="{{ $datos[3]->n_version }}" class="form-control" name="numeroVersion" min="1" required />
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
                <input type="date" id="fechaRevision" class="form-control" value="{{ isset($datos[3]->fechaRevision) ? \Carbon\Carbon::parse($datos[3]->fechaRevision)->format('Y-m-d') : '' }}" name="fechaRevision" required />
                @error('fechaRevision')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Número de Revisión
                </label>
                <input type="number" id="numeroRevision" class="form-control" value="{{ $datos[3]->n_revision }}" name="numeroRevision" placeholder="Ingrese número" min="1" required />
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
                    <option value="{{ $rol->nombreRol }}"
                        @if ($rol->nombreRol === $datos[3]->responsable) selected @endif>
                        {{ $rol->nombreRol }}
                    </option>
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
                    Número de Versión Actualizada
                </label>
                <input type="number" id="v_Actualizada" class="form-control" name="v_Actualizada" value="{{ $datos[3]->n_version_actualizada }}" placeholder="Ingrese versión" min="1" />
            </div>

            <div class="col-lg-6 field-wrapper">
                <label class="field-label">
                    Numeral
                </label>
                <input type="text" id="numeral" class="form-control" name="numeral" placeholder="Ej: 4.1.2" />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 field-wrapper">
                <label class="field-label">
                    <span class="field-icon"></span>Adjuntar Documento
                </label>

                @php
                // Obtener la ruta completa
                $ruta = $datos[3]->rutaArchivo; // por ejemplo: "documentos/tmpr-04-v02-procedimiento-inspeccion-tecnico-mecanica-trv-18.docx"
                // Extraer sólo el nombre del archivo
                $nombreArchivo = basename($ruta); // “tmpr-04-v02-procedimiento-inspeccion-tecnico-mecanica-trv-18.docx”
                @endphp

                <div id="preview-file" style="display: flex; align-items: center; gap: 8px;">
                    {{-- Aquí irá el ícono --}}
                    <span id="icono-archivo">
                        <!-- Puedes usar FontAwesome o íconos propios -->
                        @php
                        $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                        @endphp
                        @switch($ext)
                        @case('pdf')
                        <i class="fa fa-file-pdf-o" style="color: red;"></i>
                        @break
                        @case('docx') @case('doc')
                        <i class="fa fa-file-word-o" style="color: blue;"></i>
                        @break
                        @case('xlsx') @case('xls')
                        <i class="fa fa-file-excel-o" style="color: green;"></i>
                        @break
                        @case('png') @case('jpg') @case('jpeg')
                        <i class="fa fa-file-image-o" style="color: orange;"></i>
                        @break
                        @default
                        <i class="fa fa-file-o"></i>
                        @endswitch
                    </span>
                    {{-- Nombre del archivo --}}
                    <span id="nombre-archivo">{{ $nombreArchivo }}</span>
                    {{-- Botón para eliminar / cambiar --}}
                    <button type="button" id="btn-eliminar-archivo" style="background: none; border: none; color: red; cursor: pointer;">
                        &times;
                    </button>
                </div>


                <input type="file" id="archivo" name="archivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" />
                <p id="msg" class="text-center">Formatos permitidos: PDF, Word, Excel, Imágenes (JPG, PNG)</p>
                {{-- Input oculto que contiene la ruta original --}}
                <input type="text" style="display: none;" id="rutaArchivo" name="rutaArchivo" value="{{ $ruta }}" />

                @error('archivo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror


            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 field-wrapper">
                <label class="field-label">
                    Observaciones
                </label>
                <textarea name="observaciones" id="observaciones" class="form-control" cols="30" rows="8" placeholder="Ingrese observaciones adicionales...">{{ $datos[3]->observaciones }}</textarea>

                <div class="d-flex justify-content-end mt-1">
                    <small id="observacionesCount" aria-live="polite">0/1500</small>
                </div>

            </div>
        </div>

    </div>

    <button class="btn-submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 1200 1200">
            <path fill="currentColor" d="M600 0C268.629 0 0 268.629 0 600s268.629 600 600 600s600-268.629 600-600S931.371 0 600 0m257.446 281.03l124.657 124.658l-389.354 389.43L468.823 918.97L344.165 794.312l-126.27-126.344l123.853-123.853l126.27 126.343z" />
        </svg>

        Actualizar Documento

    </button>


    <!-- Recibir el mensaje y mostrarlo en un alert y luego redirigir a otra page -->
    @if(isset($documentoEditado))
    <script>
        setTimeout(() => {
            const msg = @json($documentoEditado);
            alert(msg);
        }, 0.05);
        window.location.href = "/indexDocumentos";
    </script>
    @endif

</form>
<script src="{{ asset('/js/style.js') }}"></script>

@endsection