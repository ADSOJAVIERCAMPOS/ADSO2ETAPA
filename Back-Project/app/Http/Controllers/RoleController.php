<?php

namespace App\Http\Controllers;

use App\Business\RoleBusiness;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $roleBusiness;

    public function __construct(RoleBusiness $roleBusiness)
    {
        $this->roleBusiness = $roleBusiness;
    }
    //Obtiene todos los roles
    public function index()
    {
        try {
            $roles = $this->roleBusiness->getAllRoles();
            return response()->json([
                'roles' => $roles,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining roles',
                'status' => 500
            ], 500);
        }
    }
    // Muestra un rol en especifico con el id
    public function show($id_rol)
    {
        try {
            $rol = $this->roleBusiness->getById($id_rol);
            return response()->json([
                'rol' => $rol,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining role',
                'status' => 500
            ], 500);
        }
    }
    //Crear un nuevo rol 
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name_rol' => 'required|unique:roles|max:255',
                'description_rol' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
    
            // Crear el nuevo rol
            $rol = $this->roleBusiness->create($request->all());
    
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
                'message' => 'Error creating the role',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualiza el rol
    public function update(Request $request, $id_rol)
{
    try {

        $validator = Validator::make($request->all(), [
            'name_rol' => 'required|unique:roles|max:255',
            'description_rol' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $rol = $this->roleBusiness->update($id_rol, $request->all());

        if (!$rol) {
            throw new NotFoundException('Rol not found');
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
            'message' => 'Error updating the role',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Elimina el rol
    public function destroy($id_rol)
    {
        try {
            $this->roleBusiness->delete($id_rol);
            return response()->json([
                'message' => 'Successful eliminated role',
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the role',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}