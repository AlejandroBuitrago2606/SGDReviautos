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

    <!-- Lista de documentos agregados -->

    <h1 class="text-center">Documentos Agregados</h1>

    <!-- Hacer scroll si el contenido es muy largo -->

    <div style="overflow-y: auto;">

        <form action="/indexDocumentos" class="d-flex justify-content-center mb-4">
            @csrf

            <div class="form-card">

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre Documento</th>
                                <th scope="col">Consecutivo</th>
                                <th scope="col">Versión Actualizada</th>
                                <th scope="col">Fecha de Creación</th>
                                <th scope="col">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!isset($documentos) || count($documentos) === 0)
                            <tr>
                                <td colspan="6" class="text-center">No hay documentos agregados.</td>
                            </tr>

                            @endif

                            @foreach ($documentos as $doc)
                            <tr>
                                <th scope="row">{{ $doc->idDocumento }}</th>
                                <td>{{ $doc->nombre }}</td>
                                <td>{{ $doc->consecutivo }}</td>
                                <td>{{ $doc->n_version_actualizada }}</td>
                                <td>{{ $doc->created_at  }}</td>
                                <td>{{ $doc->observaciones }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </form>
    </div>
</body>

</html>