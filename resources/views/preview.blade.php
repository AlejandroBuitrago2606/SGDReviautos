<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Vista Previa: {{ $filename }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .viewer {
            width: 100%;
            height: 90vh;
        }
    </style>
</head>

<body>

    @php
    $ext = $extension;
    @endphp

    @if(in_array($ext, ['jpg','jpeg','png']))
    <img src="{{ $url }}" class="viewer">

    @elseif($ext == 'pdf')
    <iframe src="{{ $url }}" width="100" height="100%" class="viewer"></iframe>

    @elseif(in_array($ext, ['doc','docx','xls','xlsx']))
    {{-- Usamos Office Viewer de Microsoft para leer Word/Excel --}}
       <iframe
        src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($url) }}"
        class="viewer">
    </iframe>

    @else
    <p>No se puede previsualizar este tipo de archivo.</p>
    @endif

</body>

</html>