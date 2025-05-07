<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Business\UserBusiness;
use App\Exceptions\NotFoundException;
use App\Mail\DefaultPasswordMail;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected $userBusiness;

    public function __construct(UserBusiness $userBusiness)
    {
        $this->userBusiness = $userBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $users = $this->userBusiness->getAll();
            return response()->json([
                'users' => $users,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining user',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_user)
    {
        try {
            $user = $this->userBusiness->getById($id_user);
            return response()->json([
                'user' => $user,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining user',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|unique:users|max:255', 
                'state_user' => 'required',
                'person_id' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $user = $this->userBusiness->create($request->all());
    
            return response()->json([
                'message' => 'successful create',
                'status' => 201
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
                'status' => 400
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating the user',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    public function sendDefaultPassword(Request $request, $userId)
    {
        // Buscar al usuario por su ID
        $user = Users::findOrFail($userId);

        // Generar una contraseña aleatoria
        $defaultPassword = Str::random(10);

        // Actualizar la contraseña del usuario en la base de datos
        $user->password = Hash::make($defaultPassword);
        $user->save();

        // Enviar un correo con la contraseña predeterminada
        Mail::to($user->email)->send(new DefaultPasswordMail($defaultPassword));

        return response()->json(['message' => 'Contraseña enviada por correo.']);
    }
    //Actualizar
    public function update(Request $request, $id_user)
{
    try {

        $validator = Validator::make($request->all(), [
            'password' => 'required|unique:users|max:255', 
            'state_user' => 'required',
            'person_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $user = $this->userBusiness->update($id_user, $request->all());

        if (!$user) {
            throw new NotFoundException('not found');
        }

        return response()->json([
            'message' => 'successful update',
            'status' => 200
        ], 200);
    } catch (NotFoundException $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'status' => 404
        ], 404);
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $e->errors(),
            'status' => 400
        ], 400);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error updating the user',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_user)
    {
        try {
            $this->userBusiness->delete($id_user);
            return response()->json([
                'message' => 'Successful eliminated',
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the user',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
 
}
}
