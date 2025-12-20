<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use App\Models\Documento;
use App\Models\RolDocumento;
use App\Models\Rol;
use App\Models\Proceso;
use App\Http\Requests\StoreTipoDocumentoRequest;
use App\Http\Requests\UpdateTipoDocumentoRequest;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;

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

            return view('home');
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

            return $this->index()->with('categoriaCreada', 'Categoria creada correctamente');
        } catch (ValidationException $e) {

            return $this->index()->with('categoriaCreada', 'Ocurrió un error al crear la categoria: ' . $e->getMessage());
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
    public function update(UpdateTipoDocumentoRequest $request)
    {

        try {
            $datos = $request->validated();

            $tipoDocumento = TipoDocumento::where('id', $datos['idTipoDocumento'])->first();

            if (!$tipoDocumento) {
                throw new ValidationException("La categoria con ID " . $datos['idTipoDocumento'] . " no existe.");
            }

            $tipoDocumento->nombreDocumento = $datos['nombreCategoria'];
            $tipoDocumento->prefijo = $datos['prefijoCategoria'];
            $tipoDocumento->save();

            return view('masterpages.dashboard')->with('categoriaEditada', 'Categoria actualizada correctamente');
        } catch (ValidationException $e) {
            return view('masterpages.dashboard')->with('categoriaEditada', 'Ocurrió un error al actualizar la categoria: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $tipoDocumento = TipoDocumento::where('id', $id)->first();

            $tipoDocumento->delete();

            //return $this->index()->with('categoriaEliminada', 'Categoria eliminada correctamente');
            return view('masterpages.dashboard')->with('categoriaEliminada', 'Categoria eliminada correctamente');
        } catch (QueryException $e) {

            if ($e->getCode() === '23000') {
                 return view('masterpages.dashboard')->with('categoriaEliminada', 'Ocurrió un error al eliminar la categoria: ' . 'Existen documentos asociados a esta.');
            }
             return view('masterpages.dashboard')->with('categoriaEliminada', 'Ocurrió un error al eliminar la categoria: ' . $e->getMessage());
        }
    }
}
