<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <h1 class="text-center">Agregar Documento</h1>

    <form action="agregarDocumento" method="POST" class="p-1">
        @csrf

        <!-- Identificacion del documento -->

        <div class="card m-3 p-3 mt-5">
            <h3 class="text-center mb-5">Identificacion del documento</h3>
            <div class="row">
                <div class="col-3">
                    <h3>Proceso</h3>

                    @if (!isset($datos[0]) and !isset($datos[1]) and !isset($datos[2]) )
                    <script>
                        setTimeout(() => {
                            const msg = "No se han cargado los datos";
                            alert(msg);

                        }, 0.05);
                    </script>

                    @endif

                    <select name="proceso" class="form-control" id="proceso">
                        @foreach ($datos[0] as $proceso)
                        <option value="{{ $proceso->idProceso }}">{{ $proceso->nombreProceso.' - ' . $proceso->prefijo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <h3>Tipo de Documento</h3>
                    <select name="tipoDocumento" class="form-control" id="tipoDocumento">
                        @foreach ($datos[1] as $tp)
                        <option value="{{ $tp->idTipoDocumento }}">{{ $tp->nombreDocumento.' - ' . $tp->prefijo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <h3>N° de Consecutivo</h3>
                    <input type="text" id="consecutivo" class="form-control" name="consecutivo" placeholder="Ej: 01, 02" />
                </div>
                <div class="col-3">
                    <h3>Nombre del documento</h3>
                    <input type="text" id="nombreDocumento" class="form-control" name="nombreDocumento" />
                </div>

            </div>
        </div>











        <!-- Control de version -->

        </br>

        <div class="card m-3 p-3 mt-5">
            <h3 class="text-center mb-5">Control de version</h3>

            <div class="row">
                <div class="col-4">
                    <h1>Fecha de creacion</h1>
                    <input type="date" id="fechaCreacion" class="form-control" name="fechaCreacion" />
                </div>
                <div class="col-4">
                    <h1>Fecha de version</h1>
                    <input type="date" id="fechaVersion" class="form-control" name="fechaVersion" />
                </div>
                <div class="col-4">
                    <h1>Numero de version</h1>
                    <input type="number" id="numeroVersion" class="form-control" name="numeroVersion" />
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-4">
                    <h1>Fecha de revision</h1>
                    <input type="date" id="fechaRevision" class="form-control" name="fechaRevision" />
                </div>
                <div class="col-4">
                    <h1>Numero de revision</h1>
                    <input type="number" id="numeroRevision" class="form-control" name="numeroRevision" />
                </div>
                <div class="col-4">
                    <h1>Responsable</h1>
                    <select name="responsable" class="form-control" id="responsable">
                        @foreach ($datos[2] as $rol)
                        <option value="{{ $rol->idRol }}">{{ $rol->nombreRol}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

        </div>


        <!-- Control de cambios -->


        <div class="card m-3 p-3 mt-5">
            <h3 class="text-center mb-5">Control de cambios</h3>

            <div class="row">
                <div class="col-4">
                    <h1>Numero de Version</h1>
                    <input type="date" id="v_Actualizada" class="form-control" name="v_Actualizada" />
                </div>
                <div class="col-4">
                    <h1>Numeral</h1>
                    <input type="number" id="numeral" class="form-control" name="numeral" />
                </div>
                <div class="col-4">
                    <h1>Oservaciones</h1>
                    <input type="date" id="observaciones" class="form-control" name="observaciones" />
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h1 class="text-center">Adjuntar documento:</h1>
                    <input type="file" id="archivo" name="archivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <p id="msg"></p>
                </div>
            </div>
        </div>




        </br>


        </br>


        </br>

        <button class="btn btn-success mt-3">Guardar Documento</button>


        @if (isset($mensaje))

        <script>
            setTimeout(() => {
                const msg = @json($mensaje);
                alert(msg);

            }, 0.05);
        </script>
        @endif


    </form>
    <script src="{{ asset('/js/style.js') }}"></script>





</body>

</html>