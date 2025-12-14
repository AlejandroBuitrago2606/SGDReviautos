<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SG Reviautos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styleDashboard.css') }}">

    <link rel="icon" href="{{ asset('/images/logoReviautos_sol_1.png') }}" type="image/x-icon" />
</head>

<body>




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

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">Mi perfil</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Configuración</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="#">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <a href="{{ url('/dashboard') }}">
                <img src="{{ asset('/images/logoReviautos.png') }}" alt="CDA logo" style="width: 290px; height: 80px;">
            </a>
        </div>

        @if (!isset($lista_procesos))
        <script>
            setTimeout(() => {
                const msg = "No se han cargado los datos";
                alert(msg);
            }, 0.05);
        </script>
        @endif


        <div class="menu-item">
            <a class="menu-header sin-subrayado" href="{{ url('/dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icons_dashboard" width="30" height="30" viewBox="0 0 24 24">
                    <path fill="#1c1d27ff" d="M4 19v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-3q-.425 0-.712-.288T14 20v-5q0-.425-.288-.712T13 14h-2q-.425 0-.712.288T10 15v5q0 .425-.288.713T9 21H6q-.825 0-1.412-.587T4 19" />
                </svg>
                <span>Inicio</span>
                <span class="chevron_2"></span>
            </a>
        </div>


        <div class="menu-item active">
            <div class="menu-header" onclick="toggleSubmenu(this)">
                <svg xmlns="http://www.w3.org/2000/svg" class="icons_dashboard" width="30" height="30" viewBox="0 0 2048 2048">
                    <path fill="#1c1d27ff" d="M837 844q-23 37-53 67t-68 54l51 124l-118 48l-51-123q-40 10-86 10t-86-10l-51 123l-118-48l51-124q-37-23-67-53t-54-68L63 895L15 777l123-51q-10-40-10-86t10-86L15 503l48-118l124 51q46-75 121-121l-51-124l118-48l51 123q40-10 86-10t86 10l51-123l118 48l-51 124q75 46 121 121l124-51l48 118l-123 51q10 40 10 86t-10 86l123 51l-48 118zm-325 52q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100q0 53 20 99t55 82t81 55t100 20m1408 448q0 55-14 111l137 56l-48 119l-138-57q-59 98-156 156l57 137l-119 49l-56-137q-56 14-111 14t-111-14l-56 137l-119-49l57-137q-98-58-156-156l-138 57l-48-119l137-56q-14-56-14-111t14-111l-137-56l48-119l138 57q58-97 156-156l-57-138l119-48l56 137q56-14 111-14t111 14l56-137l119 48l-57 138q97 59 156 156l138-57l48 119l-137 56q14 56 14 111m-448 320q66 0 124-25t101-68t69-102t26-125t-25-124t-69-101t-102-69t-124-26t-124 25t-102 69t-69 102t-25 124t25 124t68 102t102 69t125 25" />
                </svg>
                <span>Procesos</span>
                <span class="chevron_1">˅</span>
            </div>
            <div class="submenu">
                @foreach ($lista_procesos as $proceso)
                <a class="submenu-item sin-subrayado" href="{{ url('traerDocumentos/'.$proceso->id) }}">
                    <span>{{ $proceso->nombreProceso}}</span><span style="text-transform: uppercase;">{{' ('.$proceso->prefijo.')'}}</span>
                </a>

                @endforeach



                <a class="submenu-item-add sin-subrayado" data-bs-toggle="modal" data-bs-target="#agregarProceso">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 14 14">
                        <path fill="#fff" fill-rule="evenodd" d="M.375 12c0 .898.728 1.625 1.625 1.625h7.5c.898 0 1.625-.727 1.625-1.625v-.875H12c.898 0 1.625-.727 1.625-1.625V2c0-.897-.727-1.625-1.625-1.625H4.5c-.897 0-1.625.728-1.625 1.625v.875H2c-.897 0-1.625.728-1.625 1.625zM2 12.375A.375.375 0 0 1 1.625 12V4.5c0-.207.168-.375.375-.375h7.5c.207 0 .375.168.375.375V12a.375.375 0 0 1-.375.375zm.75-4.125a.75.75 0 0 1 .75-.75H5V6a.75.75 0 0 1 1.5 0v1.5H8A.75.75 0 0 1 8 9H6.5v1.5a.75.75 0 0 1-1.5 0V9H3.5a.75.75 0 0 1-.75-.75" clip-rule="evenodd" />
                    </svg>
                    <span>Agregar Proceso</span>
                </a>
            </div>
        </div>


        <div class="menu-item">
            <div class="menu-header" onclick="toggleSubmenu(this)">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                    <g fill="none" stroke="#1c1d27ff" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 19.5h-1c-2.828 0-4.243 0-5.121-.879C7 17.743 7 16.328 7 13.5v-2M7 8v3.5m0 0h7" />
                        <path d="M14 11.5c0-1.178 0-1.768.351-2.134C14.704 9 15.27 9 16.4 9h1.2c1.131 0 1.697 0 2.048.366c.352.366.352.956.352 2.134s0 1.768-.352 2.134c-.35.366-.917.366-2.048.366h-1.2c-1.131 0-1.697 0-2.048-.366C14 13.268 14 12.678 14 11.5Zm0 8c0-1.178 0-1.768.351-2.134C14.704 17 15.27 17 16.4 17h1.2c1.131 0 1.697 0 2.048.366c.352.366.352.956.352 2.134s0 1.768-.352 2.134c-.35.366-.917.366-2.048.366h-1.2c-1.131 0-1.697 0-2.048-.366C14 21.268 14 20.678 14 19.5ZM5.286 2h3.428C10.79 2 11 3.11 11 5s-.211 3-2.286 3H5.286C3.21 8 3 6.89 3 5s.211-3 2.286-3Z" />
                    </g>
                </svg>
                <span>Clasificación</span>
                <span class="chevron_2">˅</span>
            </div>
            <div class="submenu">
                <a class="submenu-item sin-subrayado" data-bs-toggle="modal" data-bs-target="#gestionarProceso" href="{{ url('#') }}">
                    <span>Gestionar procesos</span>
                </a>
                <a class="submenu-item sin-subrayado" data-bs-toggle="modal" data-bs-target="#gestionarCategoria" href="{{ url('#') }}">
                    <span>Gestionar categorias</span>
                </a>

            </div>
        </div>


        <div class="menu-item">
            <a class="menu-header sin-subrayado" href="{{ url('/usuarios') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                    <path fill="#1c1d27ff" d="M20.37 21.25a.75.75 0 0 1-.75.75H4.38a.75.75 0 0 1-.75-.75c0-4.1 4.5-7.28 8.37-7.28s8.37 3.18 8.37 7.28M17.1 7.11A5.1 5.1 0 1 1 12 2a5.11 5.11 0 0 1 5.1 5.11" />
                </svg>
                <span>Usuarios</span>

                <span class="chevron_2"></span>
            </a>
        </div>





    </div>









    <!-- Contenido Principal -->
    <div class="main-content">

        @yield('content')



    </div>




    <form action="/agregarProceso" method="POST">

        @csrf

        <div class="modal fade modal-lg" id="agregarProceso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="agregarProcesoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4" id="agregarProcesoLabel">Agregar nuevo proceso</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="nombreProceso" class="form-label">Nombre del proceso</label>
                        <input type="text" class="form-control" id="nombreProceso" name="nombreProceso" required maxlength="80">
                        <br>
                        <label for="prefijoProceso" class="form-label">Identificacion del proceso</label>
                        <input type="text" class="form-control" id="prefijoProceso" name="prefijoProceso" placeholder="Prefijo" required maxlength="3">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary fz-4" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-success fz-4">Agregar</button>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($procesoMensaje))
        <script>
            setTimeout(() => {
                const msg = @json($procesoMensaje);
                alert(msg);
            }, 0.05);
        </script>
        @endif


    </form>


    @include('gestionDocumentos')



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <footer style="zoom: 80%;" class="bg-dark text-light py-5 mt-5" role="contentinfo" aria-label="Pie de página">
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