@extends('masterpages.dashboard')


@section('content')



<h1 class="text-center">Agregar Documento</h1>

<form action="agregarDocumento" method="POST" class="p-1" enctype="multipart/form-data">
    @csrf

    <style>
        /* Estilos mejorados para el formulario */
        .form-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: none;
            margin: 25px 15px;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .form-section:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .form-section h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 35px;
            position: relative;
            padding-bottom: 15px;
        }

        .form-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #00d646 0%, #00ff4d 100%);
            border-radius: 2px;
        }

        .field-label {
            font-size: 15px;
            font-weight: 600;
            color: #444;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .form-control:focus {
            border-color: #00d646;
            box-shadow: 0 0 0 0.2rem rgba(0, 214, 70, 0.15);
            background: #ffffff;
            outline: none;
        }

        .form-control:hover {
            border-color: #00d646;
        }

        .field-wrapper {
            margin-bottom: 20px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #00d646 0%, #00ff4d 100%);
            color: white;
            border: none;
            padding: 15px 50px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(0, 214, 70, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            margin: 40px auto 30px;
            min-width: 250px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 214, 70, 0.5);
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
            text-align: left;
        }

        /* Iconos para los campos */
        .field-icon {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #00d646;
            border-radius: 50%;
            margin-right: 8px;
        }

        /* Archivo input mejorado */
        input[type="file"] {
            padding: 15px;
            border: 2px dashed #00d646;
            background: #f8fff8;
        }

        input[type="file"]:hover {
            background: #f0fff0;
            border-color: #00ff4d;
        }

        /* Textarea mejorado */
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* Select mejorado */
        select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2300d646' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            appearance: none;
        }

        /* Espaciado responsive */
        @media (max-width: 768px) {
            .form-section {
                padding: 20px 15px;
            }

            .field-label {
                font-size: 14px;
            }

            .btn-submit {
                width: 100%;
                padding: 15px 30px;
            }
        }

        /* Mensaje de archivo */
        #msg {
            color: #666;
            font-size: 13px;
            margin-top: 8px;
            font-style: italic;
        }

        /* Animación para los campos */
        .field-wrapper {
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Identificacion del documento -->
    <div class="form-section">
        <h3 class="text-center">Identificación del Documento</h3>

        @if (!isset($datos[0]) and !isset($datos[1]) and !isset($datos[2]) )
        <script>
            setTimeout(() => {
                const msg = "No se han cargado los datos";
                alert(msg);
            }, 0.05);
        </script>
        @endif

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