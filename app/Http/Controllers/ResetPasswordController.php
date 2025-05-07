<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use App\Models\Peoples;

class ResetPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->input('email');
        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        Mail::to($email)->send(new ResetPasswordMail($token, $email));

        return response()->json(['message' => 'Correo de restablecimiento enviado'], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $reset = DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->where('email', $request->input('email'))
            ->first();

        if (!$reset) {
            return response()->json(['message' => 'Token inválido o expirado'], 400);
        }

        $people = Peoples::where('email', $request->input('email'))->first();
        if ($people) {
            $people->password = Hash::make($request->input('password'));
            $people->save();

            DB::table('password_resets')->where('email', $request->input('email'))->delete();

            return response()->json(['message' => 'Contraseña restablecida con éxito'], 200);
        }

        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
}
