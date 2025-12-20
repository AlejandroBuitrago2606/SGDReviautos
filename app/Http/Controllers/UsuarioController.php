<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Auth;
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
                'email' => $datos['correo'],
                'password' => $datos['clave'],
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
            $usuario->email = $datos['correoEdit'];
            $usuario->password = password_hash($datos['claveEdit'], PASSWORD_DEFAULT);
            $usuario->idRol = $datos['idRolEdit'];
            $usuario->save();

            return $this->index()->with('usuarioEditado', 'Usuario editado exitosamente');
        } catch (ValidationException $e) {

            return $this->index()->with('usuarioEditado', 'Error al editar el usuario: ' . $e->getMessage());
        }
    }




    public function destroy(int $id)
    {
        try {

            $usuario = Usuario::where('id', $id)->first();
            $usuario->delete();

            return $this->index()->with('usuarioEliminado', 'Usuario eliminado exitosamente');
        } catch (ValidationException $e) {
            return $this->index()->with('usuarioEliminado', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }

    public function viewLoginForm()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
