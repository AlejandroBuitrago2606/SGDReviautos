<?php

namespace App\Http\Controllers;

use App\Models\Proceso;
use App\Models\TipoDocumento;
use App\Http\Requests\StoreProcesoRequest;
use App\Http\Requests\UpdateProcesoRequest;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masterpages.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProcesoRequest $request)
    {
        try {
            $datos = $request->validated();
            Proceso::create([
                "nombreProceso" => $datos["nombreProceso"],
                "prefijo" => $datos["prefijoProceso"]
            ]);

            return $this->index()->with('procesoMensaje', 'Proceso creado correctamente');
        } catch (ValidationException $e) {

            return $this->index()->with('procesoMensaje', 'Ocurrió un error al crear la categoria: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proceso $proceso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proceso $proceso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProcesoRequest $request)
    {
        try {
            $datos = $request->validated();

            $proceso = Proceso::where('idProceso', $datos['idProceso'])->first();

            if (!$proceso) {
                throw new ValidationException("El proceso con ID " . $datos['idProceso'] . " no existe.");
            }

            $proceso->nombreProceso = $datos['nombreProceso'];
            $proceso->prefijo = $datos['prefijoProceso'];
            $proceso->save();

            return $this->index()->with('procesoEditado', 'Proceso actualizado correctamente');
        } catch (ValidationException $e) {
            return $this->index()->with('procesoEditado', 'Ocurrió un error al actualizar la categoria: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $proceso = Proceso::where('idProceso', $id)->first();

            $proceso->delete();

            return view('masterpages.dashboard')->with('procesoEliminado', 'Proceso eliminado correctamente');
        } catch (QueryException $e) {

            if ($e->getCode() === '23000') {
                return view('masterpages.dashboard')->with('procesoEliminado', 'Ocurrió un error al eliminar el proceso: ' . 'Existen documentos y categorias asociados a este.');
            }
            return view('masterpages.dashboard')->with('procesoEliminado', 'Ocurrió un error al eliminar el proceso: ' . $e->getMessage());
        }
    }
}
