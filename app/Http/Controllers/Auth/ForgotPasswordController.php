<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');
        $existe = \App\Models\Usuario::where('email', $email)->exists();
        if ($existe) {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? view('/login', ['correoExiste' => 'success'])
                : view('/login', ['correoExiste' => 'error']);

        } else {
          return view('/login', ['correoExiste' => 'null']);
        }
    }
}
