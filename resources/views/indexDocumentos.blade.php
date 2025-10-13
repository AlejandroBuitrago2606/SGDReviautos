<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- Lista de documentos agregados -->

    <h1 class="text-center">Documentos Agregados</h1>


    @if (isset($mensaje))

    <script>
        setTimeout(() => {
            const msg = @json($mensaje);
            alert(msg);

        }, 0.05);
    </script>
    @endif

</body>

</html>