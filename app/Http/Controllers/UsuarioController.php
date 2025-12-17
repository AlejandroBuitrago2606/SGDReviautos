<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;

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
        try {

            $datos = $request->validated();
            $datos['clave'] = password_hash($datos['clave'], PASSWORD_DEFAULT);

            Usuario::create([
                'nombreUsuario' => $datos['nombreUsuario'],
                'telefono' => $datos['telefono'],
                'correo' => $datos['correo'],
                'clave' => $datos['clave'],
                'idRol' => $datos['idRol']
            ]);

            return $this->index()->with('usuarioCreado', 'Usuario creado exitosamente');
        } catch (ValidationException $e) {
            return $this->index()->with('usuarioCreado', 'Error al crear el usuario: ' . $e->getMessage());
        }
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
    public function update(UpdateUsuarioRequest $request)
    {

        try {
            //code...

            $datos = $request->validated();
            $idUsuario = $datos['idUsuarioEdit'];

            $usuario = Usuario::where('id', $idUsuario)->first();
            $usuario->nombreUsuario = $datos['nombreUsuarioEdit'];
            $usuario->telefono = $datos['telefonoEdit'];
            $usuario->correo = $datos['correoEdit'];
            $usuario->clave = password_hash($datos['claveEdit'], PASSWORD_DEFAULT);
            $usuario->idRol = $datos['idRolEdit'];
            $usuario->save();

            return $this->index()->with('usuarioEditado', 'Usuario editado exitosamente');
        } catch (ValidationException $e) {

            return $this->index()->with('usuarioEditado', 'Error al editar el usuario: ' . $e->getMessage());
        
        }
    }




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
            return view('/login', ['usuario' => 'Usuario verificado']);
        } else {
            return view('/login', ['usuario' => 'Credenciales invalidas']);
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
