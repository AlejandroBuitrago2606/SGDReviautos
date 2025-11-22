<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Proceso;
use App\Models\TipoDocumento;
use App\Models\Rol;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDocumentoRequest;
use App\Http\Requests\UpdateDocumentoRequest;
use App\Models\RolDocumento;
use App\Models\Usuario;
use Dotenv\Exception\ValidationException;
use Exception;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idProceso = session()->get('idProceso', 0);

        if ($idProceso > 0) {
            $lista_documentos = Documento::with('tipoDocumento')
                ->where('idProceso', $idProceso)
                ->get();
                
            $documentosAgrupados = $lista_documentos->groupBy('idTipoDocumento');


            $TiposDoc = TipoDocumento::All();

            foreach ($documentosAgrupados as $idTipoDocumento => $docs) {
                $documentosAgrupados[$TiposDoc->find($idTipoDocumento)->nombreDocumento] = $docs;
                unset($documentosAgrupados[$idTipoDocumento]);
            }

            $procesos = Proceso::all();
            $roles = Rol::all();
            $accesos = RolDocumento::all();
            $lista_Datos = [$documentosAgrupados, $roles, $accesos, $procesos, $TiposDoc];
            return view('/indexDocumentos', ['lista_Datos' => $lista_Datos]);
        } else {
            return view('masterpages.dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $procesos = Proceso::all();
        $tp = TipoDocumento::All();
        $roles = Rol::all();
        $datos = [$procesos, $tp, $roles];
        return view('/agregarDocumento', ['datos' => $datos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentoRequest $request)
    {

        try {
            $datos = $request->validated();

            $file = $datos["archivo"];
            $rutaArchivo = $this->guardarArchivo($file);
            if (!isset($rutaArchivo)) {
                throw new Exception("Error al guardar el archivo", 500);
            }


            Documento::create([
                "consecutivo" => $datos["consecutivo"],
                "nombre" => $datos["nombreDocumento"],
                "fechaCreacion" => $datos["fechaCreacion"],
                "fechaVersion" => $datos["fechaVersion"],
                "n_version" => $datos["numeroVersion"],
                "fechaRevision" => $datos["fechaRevision"],
                "n_revision" => $datos["numeroRevision"],
                "n_version_actualizada" => $datos["v_Actualizada"],
                "numeral" => $datos["numeral"],
                "observaciones" => $datos["observaciones"],
                "responsable" => $datos["responsable"],
                "idProceso" => $datos["idProceso"],
                "idTipoDocumento" => $datos["idTipoDocumento"],
                "rutaArchivo" => $rutaArchivo
            ]);

            //retorno la vista con mensaje de exito pero trayendo el metodo create
            return $this->create()->with('documentoCreado', 'Documento guardado exitosamente');
        } catch (ValidationException $e) {

            return $this->create()->with('documentoCreado', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        $datos = Documento::all()->where('idDocumento', $documento->idDocumento)->first();
        return $datos;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {

        $procesos = Proceso::all();
        $tp = TipoDocumento::All();
        $roles = Rol::all();
        $objDoc = Documento::where('idDocumento', $id)->first();
        $datos = [$procesos, $tp, $roles, $objDoc];

        return view('/editarDocumento', ['datos' => $datos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentoRequest $request, int $idDocumento)
    {
        try {
            $datos = $request->validated();

            $ruta_de_archivo = $datos["rutaArchivo"];
            $rutaArchivo = null;


            if (!isset($ruta_de_archivo)) {

                if (!isset($datos["archivo"])) {
                    throw new Exception("No se ha proporcionado un archivo para actualizar", 400);
                }

                $archivo = $datos["archivo"];

                // se guarda el archivo en el servidor
                $rutaArchivo = $this->guardarArchivo($archivo);

                if (!isset($rutaArchivo)) {
                    throw new Exception("Error al guardar el archivo", 500);
                }
            } else {
                $rutaArchivo = $ruta_de_archivo;
            }



            $documento = Documento::where('idDocumento', $idDocumento)->first();

            $documento->consecutivo = $datos["consecutivo"];
            $documento->nombre = $datos["nombreDocumento"];
            $documento->fechaCreacion = $datos["fechaCreacion"];
            $documento->fechaVersion = $datos["fechaVersion"];
            $documento->n_version = $datos["numeroVersion"];
            $documento->fechaRevision = $datos["fechaRevision"];
            $documento->n_revision = $datos["numeroRevision"];
            $documento->n_version_actualizada = $datos["v_Actualizada"];
            $documento->numeral = $datos["numeral"];
            $documento->observaciones = $datos["observaciones"];
            $documento->responsable = $datos["responsable"];
            $documento->idProceso = $datos["idProceso"];
            $documento->idTipoDocumento = $datos["idTipoDocumento"];
            $documento->rutaArchivo = $rutaArchivo;

            $documento->save();

            return $this->edit($idDocumento)->with('documentoEditado', 'Documento editado exitosamente');
        } catch (ValidationException $e) {

            return $this->edit($idDocumento)->with('documentoEditado', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $idDocumento)
    {


        try {

            $documento = Documento::where('idDocumento', $idDocumento)->first();
            //eliminamos primero el archivo fisico
            if (Storage::disk('public')->exists($documento->rutaArchivo)) {
                Storage::disk('public')->delete($documento->rutaArchivo);
            }
            $documento->delete();

            return $this->index()->with('documentoEliminado', 'Documento eliminado exitosamente');
        } catch (Exception $e) {

            return $this->index()->with('documentoEliminado', 'Error al eliminar el documento: ' . $e->getMessage());
        }
    }

    private function guardarArchivo($file)
    {
        // Carpeta donde guardar 
        $folder = 'documentos';
        $rutaArchivo = null;
        try {

            if (! Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }


            $timestamp = \Carbon\Carbon::now()->format('Ymd_His');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $slugName = Str::slug($originalName);
            $extension = $file->getClientOriginalExtension();

            $filename = $timestamp . '_' . $slugName . '.' . $extension;


            $rutaArchivo = $file->storeAs($folder, $filename, 'public');
        } catch (Exception $e) {

            throw new Exception('Error al guardar el archivo: ' . $e->getMessage());
        }


        return $rutaArchivo;
    }


    public function select(int $id)
    {
        session(['idProceso' => $id]);
        return redirect('/indexDocumentos');
    }
}

