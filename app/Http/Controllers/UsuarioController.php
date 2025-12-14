<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $roles = Rol::all();

        return view('/usuarios', ['usuarios' => $usuarios, 'roles' => $roles]);
    
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
    public function store(StoreUsuarioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $clave = $request->input('clave');

        if (!isset($correo) || !isset($clave)) {
            return response()->json(['message' => 'Correo y clave son requeridos'], 400);
        }

        $usuario = new Usuario();
        $usuario->correo = $correo;
        //Encriptar la clave antes de asignarla
        //$usuario->clave = password_hash($clave, PASSWORD_DEFAULT);.
        $usuario->clave = $clave;
        $usuarioVerificado = $this->verificarUsuario($usuario);

        if ($usuarioVerificado) {
            return view('/login',['usuario' => 'Usuario verificado']);
        } else {
            return view('/login',['usuario' => 'Credenciales invalidas']);
            
        }
    }


    public function verificarUsuario(Usuario $usuario): Usuario|null
    {
        $existe = Usuario::where('correo', $usuario->correo)
            ->where('clave', $usuario->clave)
            ->first();

        if ($existe) {
            return $usuario;
        } else {
            return null;
        }
    }
}
