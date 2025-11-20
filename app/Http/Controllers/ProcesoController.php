<?php

namespace App\Http\Controllers;

use App\Models\Proceso;
use App\Models\TipoDocumento;
use App\Http\Requests\StoreProcesoRequest;
use App\Http\Requests\UpdateProcesoRequest;
use Dotenv\Exception\ValidationException;

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

            return $this->index()->with('procesoMensaje', 'Categoria proceso creada correctamente');

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
    public function update(UpdateProcesoRequest $request, Proceso $proceso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proceso $proceso)
    {
        //
    }


  
}
