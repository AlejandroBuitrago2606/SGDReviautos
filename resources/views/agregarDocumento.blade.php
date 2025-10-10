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

    <form class="p-1">
        @csrf

        <!-- Identificacion del documento -->

        <div class="p-5 mt-5">
            <div class="row">
                <div class="col-3">
                    <h3>Proceso</h3>
                    <select name="proceso" class="form-control" id="proceso">
                    </select>
                </div>
                <div class="col-3">
                    <h3>Tipo de Documento</h3>
                    <select name="tipoDocumento" class="form-control" id="tipoDocumento">
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


        <h1>Fecha de creacion</h1>
        <input type="date" id="fechaCreacion" class="form-control" name="fechaCreacion" />

        </br>
        <h1>Fecha de version</h1>
        <input type="date" id="fechaVersion" class="form-control" name="fechaVersion" />

        </br>
        <h1>Numero de version</h1>
        <input type="number" id="numeroVersion" class="form-control" name="numeroVersion" />

        </br>
        <h1>Fecha de revision</h1>
        <input type="date" id="fechaRevision" class="form-control" name="fechaRevision" />

        </br>
        <h1>Numero de revision</h1>
        <input type="number" id="numeroRevision" class="form-control" name="numeroRevision" />

        </br>
        <h1>Responsable</h1>
        <select name="responsable" class="form-control" id="responsable">
            <option value="responsable1">Coordinador sistema de gestion</option>
            <option value="responsable2">Responsable del proceso</option>
            <option value="responsable2">Gerente</option>
            <option value="responsable2">Director Tecnico</option>
            <option value="responsable2">Auxiliar de ingreso</option>

        </select>




        <!-- Control de cambios -->


        </br>
        <h1>Numero de Version</h1>
        <input type="date" id="v_Actualizada" class="form-control" name="v_Actualizada" />

        </br>
        <h1>Numeral</h1>
        <input type="number" id="numeral" class="form-control" name="numeral" />

        </br>
        <h1>Oservaciones</h1>
        <input type="date" id="observaciones" class="form-control" name="observaciones" />

        <h1>Adjuntar documento:</h1>
        <input type="file" id="archivo" name="archivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
        <p id="msg"></p>

        
        <button class="btn btn-success mt-3">Guardar Documento</button>

    </form>
    <script src="{{ asset('/js/style.js') }}"></script>


</body>

</html>