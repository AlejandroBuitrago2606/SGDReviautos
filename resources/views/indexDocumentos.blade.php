@extends('masterpages.dashboard')


@section('content')


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/indexDocumentos.css') }}">




<!-- Main Content -->
<div class="main-content" style="margin-left: 1px;">
    <h1 class="page-title">Gestión y planeación estratégica</h1>

    <button class="btn-add-top">
        <span style="font-size: 20px; font-weight: bold;">+</span>
        Agregar
    </button>

    <div class="documents-table">
        <div class="table-header">
            <div></div>
            <div style="text-align: center;">Descargar</div>
            <div style="text-align: center;">Ver</div>
            <div style="text-align: center;">Editar</div>
            <div style="text-align: center;">Eliminar</div>
        </div>

        <div class="table-row">
            <div class="document-name">Instructivo de ingreso de datos</div>
            <div class="action-buttons">
                <button class="action-btn btn-download" title="Descargar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-view" title="Ver">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-edit" title="Editar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-delete" title="Eliminar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="table-row">
            <div class="document-name">Instructivo de recepcion de un vehiculo</div>
            <div class="action-buttons">
                <button class="action-btn btn-download" title="Descargar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-view" title="Ver">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-edit" title="Editar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-delete" title="Eliminar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="table-row">
            <div class="document-name">Instructivo de recepcion de un vehiculo</div>
            <div class="action-buttons">
                <button class="action-btn btn-download" title="Descargar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-view" title="Ver">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-edit" title="Editar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-delete" title="Eliminar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="table-row">
            <div class="document-name">Instructivo de recepcion de un vehiculo</div>
            <div class="action-buttons">
                <button class="action-btn btn-download" title="Descargar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-view" title="Ver">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-edit" title="Editar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                </button>
            </div>
            <div class="action-buttons">
                <button class="action-btn btn-delete" title="Eliminar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
    // Event listeners para los botones
    document.querySelectorAll('.btn-download').forEach(btn => {
        btn.addEventListener('click', function() {
            alert('Descargando documento...');
        });
    });

    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', function() {
            alert('Visualizando documento...');
        });
    });

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            alert('Editando documento...');
        });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('¿Está seguro de que desea eliminar este documento?')) {
                alert('Documento eliminado');
            }
        });
    });

    document.querySelector('.btn-add-top').addEventListener('click', function() {
        alert('Agregando nuevo documento...');
    });
</script>

@endsection