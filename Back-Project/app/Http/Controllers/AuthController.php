<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Users;
use App\Models\Peoples;
use App\Models\Users_role; // Importar UsersRole

class AuthController extends Controller
{
    // Método de login
    public function login(Request $request)
    {
        // Validar los campos de entrada (email y password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Buscar la persona por el email en la tabla `peoples`
        $person = Peoples::where('email', $request->email)->first();
    
        if (!$person) {
            return response()->json(['error' => 'Correo electrónico no registrado'], 404);
        }
    
        // Buscar el usuario asociado a la persona en la tabla `users`
        $user = Users::where('person_id', $person->id_person)->first();
    
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    
        // Comparar la contraseña proporcionada directamente sin encriptación
        if ($request->password !== $user->password) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
    
        // Obtener el rol desde la tabla `users_role` y la relación con `roles`
        $userRole = Users_role::where('id_user', $user->id_user)->first();
    
        if (!$userRole) {
            return response()->json(['error' => 'Rol de usuario no encontrado'], 404);
        }

        // Obtener el nombre y apellido de la persona
        $fullName = $person->name . ' ' . $person->last_name; // Asegúrate de que los campos coincidan con tu tabla

        // Obtener el rol desde la relación con la tabla `roles`
        $role = $userRole->role;

        if (!$role) {
            return response()->json(['error' => 'Rol no encontrado en la tabla de roles'], 404);
        }

        // Generar el token JWT
        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }
    
        // Devolver la data con el token, el rol (nombre y id), el email, y el nombre completo del usuario
        return response()->json([
            'data' => [
                'token' => $token,
                'email' => $request->email,
                'full_name' => $fullName, // Nombre completo
                'role' => [
                    'id' => $role->id_rol,      // ID del rol
                    'name' => $role->name_rol,   // Nombre del rol
                ]
            ]
        ]);
    }

    // Método de logout
    public function logout(Request $request)
    {
        try {
            // Obtener el token del encabezado
            $token = JWTAuth::getToken();
    
            // Verificar si el token existe
            if (!$token) {
                return response()->json(['error' => 'Token no proporcionado'], 400);
            }
    
            // Invalidar el token
            JWTAuth::invalidate($token);
    
            // Responder con un mensaje de éxito
            return response()->json(['message' => 'Sesión cerrada con éxito'], 200);
        } catch (JWTException $e) {
            // Manejar errores al invalidar el token
            return response()->json(['error' => 'No se pudo cerrar la sesión', 'details' => $e->getMessage()], 500);
        }
    }
    
}
