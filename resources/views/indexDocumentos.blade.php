@extends('masterpages.dashboard')


@section('content')


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('/css/indexDocumentos.css') }}">


<!-- Main Content -->
<div class="main-content" style="margin-left: 1px;">
    <h1 class="page-title">Gestión y planeación estratégica</h1>

    <a class="btn-add-top" href="{{ url('agregarDocumento') }}" style="text-decoration: none;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor" d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
        </svg>
        Agregar
    </a>

    <div class="documents-table">
        <div class="table-header">
            <div style="text-align: center;">Nombre del Documento</div>
            <div style="text-align: center;">Descargar</div>
            <div style="text-align: center;">Ver</div>
            <div style="text-align: center;">Editar</div>
            <div style="text-align: center;">Eliminar</div>
        </div>


        @if (!isset($documentos) || count($documentos) === 0)
        <div class="table-row">
            <div class="document-name">No hay documentos agregados.</div>
        </div>

        @endif

        @foreach ($documentos as $doc)



        <div class="table-row">

            <div class="row">

                <div class="form-group">

                    <div class="document-name">{{ $doc->nombre }}</div>

                    <!-- Trigger (puede estar dentro de tu loop) -->
                    <button class="toggle-btn" data-target="#detalles-{{$doc->idDocumento}}">
                        Ver detalles <span class="arrow">▼</span>
                    </button>

                </div>

            </div>


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


                <a href="editarDocumento/{{ $doc->idDocumento }}" class="action-btn btn-edit" title="Editar">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                </a>
            </div>
            <div class="action-buttons">
                <form method="POST" action="{{ url('eliminarDocumento/'.$doc->idDocumento) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar este documento?');" title="Eliminar">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                        </svg>
                    </button>

                    @if(isset($documentoEliminado))
                    <script>
                        setTimeout(() => {
                            const msg = @json($documentoEliminado);
                            alert(msg);
                        }, 0.05);
                        window.location.href = "/indexDocumentos";
                    </script>
                    @endif


                </form>
            </div>



            <div class="toggle-content mt-4" id="detalles-{{$doc->idDocumento}}" style="overflow-y: auto;">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="row g-3">

                            <!-- Información Principal -->


                            <div class="col-md-6">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Consecutivo</small>
                                    <p class="mb-0 fw-semibold">{{ $doc->consecutivo }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Nombre del Documento</small>
                                    <p class="mb-0 fw-semibold">{{ $doc->nombre }}</p>
                                </div>
                            </div>


                            <!-- Fechas -->


                            <div class="col-md-4">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Fecha de Creación</small>
                                    <p class="mb-0">{{ $doc->fechaCreacion }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Fecha de Versión</small>
                                    <p class="mb-0">{{ $doc->fechaVersion }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Fecha de Revisión</small>
                                    <p class="mb-0">{{ $doc->fechaRevision }}</p>
                                </div>
                            </div>


                            <!-- Versiones -->

                            <div class="col-md-4">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Número de Versión</small>
                                    <p class="mb-0"><span class="badge bg-primary">{{ $doc->n_version }}</span></p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Número de Revisión</small>
                                    <p class="mb-0"><span class="badge bg-info">{{ $doc->n_revision }}</span></p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Última Versión Modificada</small>
                                    <p class="mb-0"><span class="badge bg-success">{{ $doc->n_version_actualizada }}</span></p>
                                </div>
                            </div>


                            <!-- Información Adicional -->

                            <div class="col-12">
                                <hr class="my-3">
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Numerales</small>
                                    <p class="mb-0">{{ $doc->numeral }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <small class="text-muted d-block mb-1">Observaciones</small>
                                    <p class="mb-0">{{ $doc->observaciones ?: 'Sin observaciones' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>


        @endforeach





























        <div class="modal fade modal-xl" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

<script src="{{ asset('/js/indexDocumentos.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

@endsection