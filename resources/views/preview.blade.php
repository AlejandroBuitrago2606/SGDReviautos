<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Previa: {{ $filename }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/preview.css') }}">
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="file-info">
                <div class="file-icon">
                    @php
                    $ext = strtoupper($extension);
                    echo substr($ext, 0, 3);
                    @endphp
                </div>
                <div class="file-details">
                    <div>
                        Vista previa del documento
                        <span class="file-type-badge">{{ strtoupper($extension) }}</span>
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('preview.file', ['filename' => $filename]) }}"
                    download
                    class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5 20h14v-2H5m14-9h-4V3H9v6H5l7 7z" />
                    </svg>
                    Descargar
                </a>
                <button onclick="window.close()" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path fill="white" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
                    </svg>
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <!-- Contenedor del visor -->
    <div class="viewer-container">
        <div class="viewer-wrapper">
            <div class="loading-overlay" id="loadingOverlay">
                <div class="spinner"></div>
                <div class="loading-text">Cargando archivo...</div>
            </div>

            @php
            $ext = $extension;
            @endphp

            @if(in_array($ext, ['jpg','jpeg','png','gif','svg','webp']))
            <img src="{{ route('preview.file', ['filename' => $filename]) }}"
                class="viewer viewer-img"
                alt="{{ $filename }}"
                onload="document.getElementById('loadingOverlay').style.display='none'">

            @elseif($ext == 'pdf')
            <iframe src="{{ route('preview.file', ['filename' => $filename]) }}"
                class="viewer"
                onload="document.getElementById('loadingOverlay').style.display='none'">
            </iframe>

            @elseif(in_array($ext, ['doc','docx','xls','xlsx']))
            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(route('preview.file', ['filename' => $filename])) }}"
                class="viewer"
                onload="document.getElementById('loadingOverlay').style.display='none'">
            </iframe>
            

            @else
            <div class="error-container">
                <div class="error-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                        <path fill="#f59e0b" d="M13 14h-2V9h2m0 9h-2v-2h2M1 21h22L12 2L1 21z" />
                    </svg>
                </div>
                <div class="error-message">
                    <h2>Vista previa no disponible</h2>
                    <p>No se puede mostrar una vista previa de este tipo de archivo. Por favor, descárgalo para visualizarlo.</p>
                </div>
            </div>
            <script>
                document.getElementById('loadingOverlay').style.display = 'none';
            </script>
            @endif
        </div>
    </div>

    <script>
        // Ocultar loading después de 10 segundos como fallback
        setTimeout(() => {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = 'none';
            }
        }, 10000);
    </script>
</body>

</html>