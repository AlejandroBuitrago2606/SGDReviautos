<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDA Sistema</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styleDashboard.css') }}">
</head>

<body>



    <!-- Top Header -->
    <div class="top-header">
        <div class="user-info">
            <div>
                <div class="greeting">Buenas tardes</div>
                <div class="user-name">Administrador</div>
            </div>
            <div class="user-avatar">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">

                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('/images/logoReviautos.png') }}" alt="CDA logo" style="width: 290px; height: 80px; ml-5">
        </div>

        @if (!isset($procesos) )
        <script>
            setTimeout(() => {
                const msg = "No se han cargado los datos";
                alert(msg);

            }, 0.05);
        </script>

        @endif



        @foreach ($procesos as $proceso)


        <div class="menu-item">
            <a class="menu-header sin-subrayado" href="{{ url('traerDocumentos/'.$proceso->idProceso) }}">

                <span>{{ $proceso->nombreProceso.' ('.$proceso->prefijo.')'}}</span>
                <!-- <span class="chevron">∨</span> -->

            </a>
        </div>

        @endforeach



        <button class="btn-add" type="button">
            <span style="font-size: 20px; font-weight: bold;">+</span>
            Agregar
        </button>

    </div>



    

    <!-- Contenido Principal -->
    <div class="main-content">

        @yield('content')



    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.menu-header').forEach(header => {
            header.addEventListener('click', function() {
                const chevron = this.querySelector('.chevron');
                chevron.classList.toggle('active');
            });
        });
    </script>


    <footer class="bg-dark text-light py-5 mt-5" role="contentinfo" aria-label="Pie de página">
        <div class="container">
            <div class="row align-items-center">
                <!-- Información de la empresa -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">CDA REVI AUTOS S.A.</h5>
                    <p class="mb-2 text-light opacity-75">
                        Centro de Diagnóstico Automotor
                    </p>
                    <p class="mb-0 small text-light opacity-50">
                        © 2025 Todos los derechos reservados
                    </p>
                </div>

                <!-- Redes sociales y contacto -->
                <div class="col-lg-6">
                    <h6 class="fw-semibold mb-3">Contáctanos</h6>
                    <div class="d-flex flex-column gap-3">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/573115388301"
                            class="text-light text-decoration-none d-flex align-items-center gap-2 hover-link"
                            aria-label="Contactar por WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                            </svg>
                            <span>311 538 8301</span>
                        </a>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/cdareviautos/"
                            class="text-light text-decoration-none d-flex align-items-center gap-2 hover-link"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Visitar Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
                            </svg>
                            <span>cdareviautos</span>
                        </a>

                        <!-- Sitio Web -->
                        <a href="https://cdareviautos.com/"
                            class="text-light text-decoration-none d-flex align-items-center gap-2 hover-link"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Visitar sitio web">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-width="3">
                                    <path stroke-linejoin="round" d="M3 24a21 21 0 1 0 42 0a21 21 0 1 0-42 0" />
                                    <path stroke-linejoin="round" d="M15 24a9 21 0 1 1 18 0a9 21 0 1 1-18 0" />
                                    <path stroke-linecap="round" d="M4.5 31h39m-39-14h39" />
                                </g>
                            </svg>
                            <span>cdareviautos.com</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>