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
use Dotenv\Exception\ValidationException;
use Exception;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return view('/agregarDocumento', ["datos" => $datos]);
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
                "idProceso" => $datos["idProceso"],
                "idTipoDocumento" => $datos["idTipoDocumento"],
                "rutaArchivo" => $rutaArchivo
            ]);

            return response()->json(["mensaje" => "Documento guardado exitosamente"], 201);
        } catch (ValidationException $e) {
            return response()->json(["Error al guardar documento, Verifica los datos ingresados"], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentoRequest $request, Documento $documento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        //
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

            // Generar nombre único 
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '.' . $file->getClientOriginalExtension();

            // Guardar el archivo en storage/app/public/documentos/...
            $rutaArchivo = $file->storeAs($folder, $filename, 'public');
        } catch (Exception $e) {
            // Manejar error (puedes registrar el error o lanzar una excepción)
            throw new Exception('Error al guardar el archivo: ' . $e->getMessage());
        }

        return $rutaArchivo;
    }

    private function parsearDatos($datos)
    {


        //parsear idProceso y idTipoDocumento a enteros
        $datos["idProceso"] = (int)$datos["idProceso"];
        $datos["idTipoDocumento"] = (int)$datos["idTipoDocumento"];

        //parsear numeroVersion, numeroRevision y v_Actualizada a enteros
        $datos["numeroVersion"] = (int)$datos["numeroVersion"];
        $datos["numeroRevision"] = (int)$datos["numeroRevision"];
        if (isset($datos["v_Actualizada"])) {
            $datos["v_Actualizada"] = (int)$datos["v_Actualizada"];
        } else {
            $datos["v_Actualizada"] = null;
        }

        // parsear fechas a formato Y-m-d
        $datos["fechaCreacion"] = date('Y-m-d', strtotime($datos["fechaCreacion"]));
        $datos["fechaVersion"] = date('Y-m-d', strtotime($datos["fechaVersion"]));
        $datos["fechaRevision"] = date('Y-m-d', strtotime($datos["fechaRevision"]));

        return $datos;
    }
}
