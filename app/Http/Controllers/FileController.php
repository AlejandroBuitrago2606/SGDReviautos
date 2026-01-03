<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\RolDocumento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function preview($filename)
    {

        $accessGranted = $this->verifyAccess($filename);

        // Verificar si el usuario tiene acceso al archivo
        if (!$accessGranted) {
            return redirect('/');
        }

        session(['access' => $accessGranted]);

        // La ruta en el storage público
        $path = storage_path('app/private/' . $filename);

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return view('preview', [
            'filename'  => $filename,
            'extension' => $extension
        ]);

    }


    public function servePreview($filename)
    {

        $access = session('access', false);

        if (!$access) {
            return redirect('/');
        }
        // Ruta completa en storage privado
        $path = storage_path('app/private/' . $filename);

        // Retorna el archivo con el Content-Type correcto
        return response()->file($path);
    }


    public function verifyAccess($filename)
    {


        $user = Auth::user();


        if (!$user) {
            return false;
        }

        $documentoExiste = Documento::where('rutaArchivo', $filename)->first();
        if (!$documentoExiste) {
            return false;
        }

        $acceso = RolDocumento::where('idDocumento', $documentoExiste->id)
            ->where('idRol', $user->idRol)
            ->first();

        if (!isset($acceso) || ($acceso->acceso == 0)) {

            if ($user->idRol != 4) {
                return false;
            }
        }

        if (!Storage::disk('private')->exists($filename)) {
            return false;
        }

        return true;
    }

}
