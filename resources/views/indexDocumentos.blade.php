@extends('masterpages.dashboard')


@section('content')


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('/css/indexDocumentos.css') }}">


<!-- Main Content -->
<div class="main-content" style="margin-left: 1px;">

    @if (isset($lista_Datos[3]))
        @php
            $idPr = session()->get('idProceso', 0);
        @endphp

        @foreach ($lista_Datos[3] as $pr)

            @if ($pr->idProceso === $idPr)
                <h1 class="page-title">{{ $pr->nombreProceso }}</h1>
            @endif
        
        @endforeach

    @endif
    

    <a class="btn-add-top" href="{{ url('agregarDocumento') }}" style="text-decoration: none; text-transform: uppercase; font-size: 18px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor" d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
        </svg>
        Agregar Documento
    </a>

    

    <div class="documents-table">



        @if (!isset($lista_Datos[0]) || count($lista_Datos[0]) === 0)
        <div class="table-row">
            <div class="document-name">No hay documentos agregados.</div>
        </div>

        @endif


        @foreach ($lista_Datos[0] as $tipoDocumento => $docsEnTipo)

            <div class="table-header">
                <div style="text-align: center; text-transform: uppercase;">{{ $tipoDocumento }}</div>
            </div>


            @foreach ($docsEnTipo as $doc)



            <div class="table-row">

                <div class="row">

                    <div class="form-group">

                        @if(isset($lista_Datos[3]) && isset($lista_Datos[4]))

                            @php
                                $proceso_name="";
                                $categoria_name="";
                            @endphp

                            @foreach ($lista_Datos[3] as $proceso)
                            
                                @if ($proceso->idProceso === $doc->idProceso )

                                    @php
                                        $proceso_name = $proceso->prefijo
                                    @endphp
                                    
                                
                                @endif

                            @endforeach

                            @foreach ($lista_Datos[4] as $categoria)
                            
                                @if ($categoria->idTipoDocumento === $doc->idTipoDocumento )

                                    @php
                                        $categoria_name = $categoria->prefijo
                                    @endphp
                                    
                                
                                @endif
                            @endforeach

                            <div class="document-name">{{ $proceso_name }}-{{ $categoria_name }} {{ $doc->consecutivo }} V{{ $doc->n_version }}. {{ $doc->nombre }}</div>


                        @else
                            <div class="document-name">{{ $doc->nombre }}</div>

                        @endif

                    





                        



                        <!-- Trigger (puede estar dentro de tu loop) -->
                        <button class="toggle-btn" data-target="#detalles-{{$doc->idDocumento}}">
                            Ver detalles <span class="arrow">▼</span>
                        </button>

                    </div>

                </div>

                <div class="action-buttons">
                    <button class="action-btn btn-download" id="btnDescargar" name="btnDescargar" title="Descargar">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
                        </svg>
                    </button>
                    <div class="label">Descargar</div>
                </div>

                <div class="action-buttons">
                    <button class="action-btn btn-view" title="Ver">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                        </svg>
                    </button>
                    <div class="label">Ver Documento</div>
                </div>

                <div class="action-buttons">
                    <a href="editarDocumento/{{ $doc->idDocumento }}" class="action-btn btn-edit" title="Editar">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                    </a>
                    <div class="label">Editar</div>
                </div>

                <div class="action-buttons">
                    <a href="javascript:void(0)"
                        class="action-btn btn-acceso"
                        title="Acceso de archivos"
                        data-doc-id="{{ $doc->idDocumento }}">
                        <!-- tu svg -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 24 24">
                            <path fill="#fff" d="M20.37 21.25a.75.75 0 0 1-.75.75H4.38a.75.75 0 0 1-.75-.75c0-4.1 4.5-7.28 8.37-7.28s8.37 3.18 8.37 7.28M17.1 7.11A5.1 5.1 0 1 1 12 2a5.11 5.11 0 0 1 5.1 5.11" />
                        </svg>
                    </a>
                    <div class="label">Acceso al documento</div>
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
                            window.location.href = "{{ url('indexDocumentos') }}";
                        </script>
                        @endif


                    </form>
                    <div class="label">Eliminar</div>
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
                                        <small class="text-muted d-block mb-1">Responsable</small>
                                        <p class="mb-0">{{ $doc->responsable }}</p>
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

        @endforeach




        <div class="table-header mt-3">
            <button class="btn-add" style="width: fit-content; text-decoration: none;" data-bs-toggle="modal" data-bs-target="#agregarCategoria">
                <span style="font-size: 13px; font-weight: bold;">+</span>
                AGREGAR CATEGORIA
            </button>
        </div>





        <form action="/agregarCategoria" method="POST">

            @csrf

            <div class="modal fade modal-lg" id="agregarCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="agregarCategoriaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="agregarCategoriaLabel">Agregar nueva categoria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="nombreCategoria" class="form-label">Nombre de la categoria</label>
                            <input type="text" class="form-control" id="nombreCategoria" name="nombreCategoria" required maxlength="20">
                            <br>
                            <label for="prefijoCategoria" class="form-label">Identificacion de la categoria</label>
                            <input type="text" class="form-control" id="prefijoCategoria" name="prefijoCategoria" placeholder="Prefijo" required maxlength="3">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary fz-4" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success fz-4">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($categoriaCreada))
            <script>
                setTimeout(() => {
                    const msg = @json($categoriaCreada);
                    alert(msg);
                }, 0.05);
            </script>
            @endif


        </form>





        <form action="/acceso" method="POST">

        @csrf

            <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="staticBackdropLabel">Usuarios con accceso al documento</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5">

                            @if (isset($lista_Datos[2]) && count($lista_Datos[2]) > 0)

                            @if (!isset($lista_Datos[1]) || count($lista_Datos[1]) === 0 && !isset($lista_Datos[2]) || count($lista_Datos[2]) === 0)
                            <div class="table-row">
                                <div class="document-name">No hay roles agregados.</div>
                            </div>

                            @endif



                            

                            @php
                            $idDocSeleccionado = session()->get('idDocumento',0);
                            @endphp

                            <input type="hidden" id="idDocumento" name="idDocumento" value="{{ $idDocSeleccionado }}">

                            @foreach ($lista_Datos[1] as $rol)

                            @php
                            // Buscar si el rol tiene acceso al documento seleccionado
                            $accesoRol = collect($lista_Datos[2])->first(function ($item) use ($rol, $idDocSeleccionado) {
                            return $item->idDocumento === $idDocSeleccionado && $item->idRol === $rol->idRol;
                            });
                            @endphp

                            <div class="form-check form-switch mb-3">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $rol->idRol }}"
                                    id="rol{{ $rol->idRol }}"
                                    @if ($rol->nombreRol === "COORDINADOR DE SISTEMA DE GESTION")
                                checked disabled
                                @elseif ($accesoRol && $accesoRol->acceso === 1)
                                checked
                                @endif style="margin-right: 10px;"
                                >
                                <h5 class="form-check-label" style="margin-left: 8px;" for="rol{{ $rol->idRol }}">
                                    {{ $rol->nombreRol }}
                                </h5>
                            </div>
                            @endforeach







                            @else
                            <div class="table-row">
                                <div class="document-name">No se cargo la informacion correctamente.</div>
                            </div>
                            @endif





                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary fs-5" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary fs-5">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>


            @if(isset($acceso))
            <script>
                setTimeout(() => {
                    const msg = @json($acceso);
                    alert(msg);
                }, 0.05);
            </script>
            @endif


        </form>


    </div>

</div>

<script src="{{ asset('/js/indexDocumentos.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

@endsection