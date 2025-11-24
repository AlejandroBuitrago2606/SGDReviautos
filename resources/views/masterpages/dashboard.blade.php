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
            <img src="{{ asset('/images/logoReviautos.png') }}" alt="CDA logo" style="width: 290px; height: 80px;">
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
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
        </div>


        <div class="menu-item active">
            <div class="menu-header" onclick="toggleSubmenu(this)">
                <i class="fas fa-cogs"></i>
                <span>Procesos</span>
                <span class="chevron">›</span>
            </div>
            <div class="submenu">
                @foreach ($lista_procesos as $proceso)
                <a class="submenu-item sin-subrayado" href="{{ url('traerDocumentos/'.$proceso->idProceso) }}">
                    <span>{{ $proceso->nombreProceso.' ('.$proceso->prefijo.')'}}</span>
                </a>
                @endforeach
            </div>
        </div>


        <div class="menu-item">
            <div class="menu-header" onclick="toggleSubmenu(this)">
                <i class="fas fa-file-alt"></i>
                <span>Clasificación</span>
                <span class="chevron">›</span>
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


        <!-- Botón Agregar -->
        <button class="btn-add" type="button" data-bs-toggle="modal" data-bs-target="#agregarProceso">
            <i class="fas fa-plus"></i>
            <span>Agregar Proceso</span>
        </button>
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



    <!-- Gestionar procesos Editar/Eliminar -->
    <div class="modal fade modal-lg" id="gestionarProceso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gestionarProcesoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="gestionarProcesoLabel">Gestionar procesos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    <div class="documents-table">

                        @if (!isset($lista_procesos) || count($lista_procesos) === 0)
                        <div class="table-row">
                            <div class="document-name">No hay procesos agregados.</div>
                        </div>
                        @else

                        @foreach ($lista_procesos as $proceso)
                        <div class="table-row" style="display: flex; align-items: center; justify-content: space-between; padding: 15px 20px; gap: 15px;">

                            <div style="flex: 1; min-width: 0;" id="infoProceso{{ $proceso->idProceso }}">
                                <div class="document-name" style="margin: 0;">{{ $proceso->nombreProceso }} ({{ $proceso->prefijo }})</div>
                            </div>

                            <br>

                            <div class="form-group" id="formEditar{{ $proceso->idProceso }}" style="display: none; flex: 1; min-width: 0;">

                                <input type="text" class="form-control document-input mb-1" name="nombreProceso" value="{{ $proceso->nombreProceso }}">
                                <input type="text" name="prefijoProceso" class="form-control document-input" value="{{ $proceso->prefijo }}">

                            </div>

                            <div style="display: flex; gap: 20px; flex-shrink: 0;">
                                <div class="action-buttons" id="btnEdit{{ $proceso->idProceso }}" data-proceso-id="{{ $proceso->idProceso }}" onclick="mostrarForm(event)" style="margin: 0;">
                                    <button class="action-btn btn-edit" title="Editar"  style="margin-bottom: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                        </svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Editar</div>
                                </div>

                                <div class="action-buttons" id="btnSave{{ $proceso->idProceso }}" style="margin: 0; display: none;">
                                    <button class="action-btn btn-save" title="Guardar" style="margin-bottom: 5px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="#fff" d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                        </svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Guardar</div>
                                </div>

                                <div class="action-buttons" id="btnAtras{{ $proceso->idProceso }}" data-proceso-id="{{ $proceso->idProceso }}" onclick="mostrarForm(event)" style="margin: 0; display: none;">
                                    <button class="action-btn btn-delete" title="Cancelar" style="margin-bottom: 5px;">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22"/></svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Cancelar</div>
                                </div>

                                <div class="action-buttons" id="btnEliminar{{ $proceso->idProceso }}" style="margin: 0; align-items: center;">
                                    <button class="action-btn btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar este proceso?');" title="Eliminar" style="margin-bottom: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Eliminar</div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                        @endif

                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary fs-5" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Gestionar categorias Editar/Eliminar -->
    <div class="modal fade modal-lg" id="gestionarCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gestionarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="gestionarCategoriaLabel">Gestionar categorias</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    <div class="documents-table">

                        @if (!isset($lista_categorias) || count($lista_categorias) === 0)
                        <div class="table-row">
                            <div class="document-name">No hay categorias creadas.</div>
                        </div>
                        @else

                        @foreach ($lista_categorias as $categoria)
                        <div class="table-row" style="display: flex; align-items: center; justify-content: space-between; padding: 15px 20px; gap: 15px;">

                            <div style="flex: 1; min-width: 0;">
                                <div class="document-name" style="margin: 0;">{{ $categoria->nombreDocumento }} ({{ $categoria->prefijo }})</div>
                            </div>

                            <div style="display: flex; gap: 20px; flex-shrink: 0;">
                                <div class="action-buttons" style="margin: 0;">
                                    <button class="action-btn btn-edit" title="Editar" style="margin-bottom: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                        </svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Editar</div>
                                </div>

                                <div class="action-buttons" style="margin: 0;">
                                    <button class="action-btn btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar esta categoria?');" title="Eliminar" style="margin-bottom: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Eliminar</div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                        @endif

                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary fs-5" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>






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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>