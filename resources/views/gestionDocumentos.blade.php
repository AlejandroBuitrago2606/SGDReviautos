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

                        <div style="flex: 1; min-width: 0; " id="infoProceso{{ $proceso->id }}">
                            <div class="document-name" style="margin: 0;">{{ $proceso->nombreProceso }} ({{ $proceso->prefijo }})</div>
                        </div>

                        <br>

                        <form action="/editarProceso" method="POST" style="flex: 1; min-width: 0;">
                            @csrf
                            @method('PATCH')

                            <div class="row" style="display: flex; align-items: center; justify-content: space-between;">

                                <div class="col-10">
                                    <div class="form-group" id="formEditar{{ $proceso->id }}" style="display: none; width: 80%;">

                                        <input type="hidden" name="idProceso" id="idProceso" value="{{ $proceso->id }}">
                                        <input type="text" class="form-control mb-1 document-name" id="nombreProceso" name="nombreProceso" value="{{ $proceso->nombreProceso }}" maxlength="80" required>
                                        <input type="text" name="prefijoProceso" class="form-control document-name" id="prefijoProceso" value="{{ $proceso->prefijo }}" required maxlength="3">

                                    </div>


                                </div>
                                <div class="col-2">
                                    <div class="action-buttons" id="btnSave{{ $proceso->id }}" style="margin: 0; display: none;">
                                        <button class="action-btn btn-save" title="Guardar" style="margin-bottom: 5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#fff" d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                            </svg>
                                        </button>
                                        <div class="label" style="white-space: nowrap;">Guardar</div>
                                    </div>
                                    <div class="action-buttons" id="btnAtras{{ $proceso->id }}" data-proceso-id="{{ $proceso->id }}" onclick="mostrarFormProceso(event)" style="margin: 0; display: none;">
                                        <button class="action-btn btn-delete" type="button" title="Cancelar" style="margin-bottom: 5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#fff" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                            </svg>
                                        </button>
                                        <div class="label" style="white-space: nowrap;">Cancelar</div>
                                    </div>
                                </div>
                            </div>

                            @if(isset($procesoEditado))
                            <script>
                                setTimeout(() => {
                                    const msg = @json($procesoEditado);
                                    alert(msg);
                                }, 0.05);
                                window.location.href = "/dashboard";
                            </script>
                            @endif


                        </form>

                        <div style="display: flex; gap: 20px; flex-shrink: 0;">

                            <div class="action-buttons" id="btnEdit{{ $proceso->id }}" data-proceso-id="{{ $proceso->id }}" onclick="mostrarFormProceso(event)" style="margin: 0;">
                                <button class="action-btn btn-edit" title="Editar" style="margin-bottom: 5px;">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                    </svg>
                                </button>
                                <div class="label" style="white-space: nowrap;">Editar</div>
                            </div>


                            <form action="/eliminarProceso/{{ $proceso->id }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <div class="action-buttons" id="btnEliminar{{ $proceso->id }}" style="margin: 0; align-items: center;">
                                    <button class="action-btn btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar este proceso? \r Eliminaras las categorias y documentos asociados a esta ');" title="Eliminar" style="margin-bottom: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Eliminar</div>
                                </div>


                                @if(isset($procesoEliminado))
                                <script>
                                    setTimeout(() => {
                                        const msg = @json($procesoEliminado);
                                        alert(msg);
                                    }, 0.05);
                                    window.location.href = "/dashboard";
                                </script>
                                @endif


                            </form>
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

                        <div style="flex: 1; min-width: 0;" id="infoCategory{{ $categoria->id }}">
                            <div class="document-name" style="margin: 0;">{{ $categoria->nombreDocumento }} ({{ $categoria->prefijo }})</div>
                        </div>

                        <br>

                        <form action="/editarCategoria" method="POST" style="flex: 1; min-width: 0;">
                            @csrf
                            @method('PATCH')

                            <div class="row" style="display: flex; align-items: center; justify-content: space-between;">

                                <div class="col-10">
                                    <div class="form-group" id="formEditarCategory{{ $categoria->id }}" style="display: none; flex: 1; min-width: 0;">

                                        <input type="hidden" name="idTipoDocumento" value="{{ $categoria->id }}">
                                        <input type="text" class="form-control mb-1 document-name" name="nombreCategoria" value="{{ $categoria->nombreDocumento }}" maxlength="20" required>
                                        <input type="text" name="prefijoCategoria" class="form-control document-name" value="{{ $categoria->prefijo }}" maxlength="3" required>

                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="action-buttons" id="btnSaveCategory{{ $categoria->id }}" style="margin: 0; display: none;">
                                        <button class="action-btn btn-save" title="Guardar" style="margin-bottom: 5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#fff" d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                            </svg>
                                        </button>
                                        <div class="label" style="white-space: nowrap;">Guardar</div>
                                    </div>

                                    <div class="action-buttons" id="btnBackCategory{{ $categoria->id }}" data-category-id="{{ $categoria->id }}" onclick="mostrarFormCategory(event)" style="margin: 0; display: none;">
                                        <button class="action-btn btn-delete" title="Cancelar" type="button" style="margin-bottom: 5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="#fff" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                            </svg>
                                        </button>
                                        <div class="label" style="white-space: nowrap;">Cancelar</div>
                                    </div>

                                </div>

                            </div>


                            @if(isset($categoriaEditada))
                            <script>
                                setTimeout(() => {
                                    const msg = @json($categoriaEditada);
                                    alert(msg);
                                }, 0.05);
                                window.location.href = "/dashboard";
                            </script>
                            @endif


                        </form>
                        <div style="display: flex; gap: 20px; flex-shrink: 0;">
                            <div class="action-buttons" id="btnEditCategory{{ $categoria->id}}" data-category-id="{{ $categoria->id }}" onclick="mostrarFormCategory(event)" style="margin: 0;">
                                <button class="action-btn btn-edit" title="Editar" style="margin-bottom: 5px;">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                    </svg>
                                </button>
                                <div class="label" style="white-space: nowrap;">Editar</div>
                            </div>

                            <form action="/eliminarCategoria/{{ $categoria->id }}" method="POST">

                                @csrf
                                @method('DELETE')


                                <div class="action-buttons" id="btnDeleteCategory{{ $categoria->id }}" style="margin: 0; align-items: center;">
                                    <button class="action-btn btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar esta categoria?  \r Eliminaras todos los documentos asociados a esta');" title="Eliminar" style="margin-bottom: 5px;">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                    <div class="label" style="white-space: nowrap;">Eliminar</div>
                                </div>

                                @if(isset($categoriaEliminada))
                                <script>
                                    setTimeout(() => {
                                        const msg = @json($categoriaEliminada);
                                        alert(msg);
                                    }, 0.05);
                                    window.location.href = "{{ url('/dashboard') }}";
                                </script>
                                @endif

                            </form>
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