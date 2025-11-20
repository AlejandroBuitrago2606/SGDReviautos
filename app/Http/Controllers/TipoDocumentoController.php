<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use App\Models\Documento;
use App\Models\RolDocumento;
use App\Models\Rol;
use App\Http\Requests\StoreTipoDocumentoRequest;
use App\Http\Requests\UpdateTipoDocumentoRequest;
use Dotenv\Exception\ValidationException;

class TipoDocumentoController extends Controller
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


            $tp = TipoDocumento::All();

            foreach ($documentosAgrupados as $idTipoDocumento => $docs) {
                $documentosAgrupados[$tp->find($idTipoDocumento)->nombreDocumento] = $docs;
                unset($documentosAgrupados[$idTipoDocumento]);
            }


            $roles = Rol::all();
            $accesos = RolDocumento::all();
            $lista_Datos = [$documentosAgrupados, $roles, $accesos];
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipoDocumentoRequest $request)
    {
        try {
            $datos = $request->validated();
            TipoDocumento::create([
                "nombreDocumento" => $datos["nombreCategoria"],
                "prefijo" => $datos["prefijoCategoria"]
            ]);

            return $this->index()->with('categoria', 'Categoria creada correctamente');

        } catch (ValidationException $e) {
            
            return $this->index()->with('categoria', 'Ocurrió un error al crear la categoria: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipoDocumentoRequest $request, TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoDocumento $tipoDocumento)
    {
        //
    }
}
