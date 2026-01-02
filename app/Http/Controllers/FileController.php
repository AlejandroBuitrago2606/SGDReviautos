<?php

namespace App\Http\Controllers;


class FileController extends Controller
{
    public function preview($filename)
    {
        // La ruta en el storage público
        $path = storage_path('app/public/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return view('preview', [
            'filename'  => $filename,
            'extension' => $extension,
            'url'       => asset('storage/' . $filename),
        ]);
    }
}
