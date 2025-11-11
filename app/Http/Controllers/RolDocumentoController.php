<?php

namespace App\Http\Controllers;

use App\Models\RolDocumento;
use App\Models\Rol;
use App\Http\Requests\StoreRolDocumentoRequest;
use App\Http\Requests\UpdateRolDocumentoRequest;
use Dotenv\Exception\ValidationException;

class RolDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function acceso(int $id)
    {
        session(['idDocumento' => $id]);
        return response(null, 200);
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
    public function store(StoreRolDocumentoRequest $request)
    {
        try {
            $datos = $request->validated();

            $rolesSeleccionados = $datos["roles"] ?? [];
            $idDocumento = $datos["idDocumento"];

            // Obtener los Roles no seleccionados
            $todosLosRoles = Rol::pluck('idRol');
            $rolesNoSeleccionados = $todosLosRoles->diff($rolesSeleccionados);

            // Activar acceso para roles seleccionados
            foreach ($rolesSeleccionados as $rolSeleccionado) {
                $accesoEncontrado = RolDocumento::where('idRol', $rolSeleccionado)
                    ->where('idDocumento', $idDocumento)
                    ->first();

                if (!$accesoEncontrado) {
                    RolDocumento::create([
                        "idDocumento" => $idDocumento,
                        "idRol" => $rolSeleccionado,
                        "acceso" => 1
                    ]);
                } elseif ($accesoEncontrado->acceso === 0) {
                    $accesoEncontrado->acceso = 1;
                    $accesoEncontrado->save();
                }
            }

            // Desactivar acceso para roles no seleccionados
            foreach ($rolesNoSeleccionados as $rolNoSeleccionado) {
                $accesoEncontrado = RolDocumento::where('idRol', $rolNoSeleccionado)
                    ->where('idDocumento', $idDocumento)
                    ->first();

                if ($accesoEncontrado) {
                    $accesoEncontrado->acceso = 0;
                    $accesoEncontrado->save();
                } else {
                    RolDocumento::create([
                        "idDocumento" => $idDocumento,
                        "idRol" => $rolNoSeleccionado,
                        "acceso" => 0
                    ]);
                }
            }

            return view('indexDocumentos')->with('acceso', 'Cambios guardados correctamente');
        } catch (ValidationException $e) {
            return view('indexDocumentos')->with('acceso', 'Ocurrió un error al guardar los cambios: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RolDocumento $rolDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RolDocumento $rolDocumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolDocumentoRequest $request, RolDocumento $rolDocumento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolDocumento $rolDocumento)
    {
        //
    }
}
