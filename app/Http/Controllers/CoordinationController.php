<?php

namespace App\Http\Controllers;

use App\Business\CoordinationBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CoordinationController extends Controller
{
    protected $coordinationBusiness;

    public function __construct(CoordinationBusiness $coordinationBusiness)
    {
        $this->coordinationBusiness = $coordinationBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $coordinations = $this->coordinationBusiness->getAll();
            return response()->json([
                'coordinations' => $coordinations,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining coordination',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_coordination)
    {
        try {
            $coordination = $this->coordinationBusiness->getById($id_coordination);
            return response()->json([
                'coordination' => $coordination,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining coordination',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [ 
                'area' => 'required|unique:coordinations|max:255', 

            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $coordination = $this->coordinationBusiness->create($request->all());
    
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
                'message' => 'Error creating the coordintion',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualizar
    public function update(Request $request, $id_coordination)
{
    try {

        $validator = Validator::make($request->all(), [
            'area' => 'required|unique:coordinations|max:255', 
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $coordination = $this->coordinationBusiness->update($id_coordination, $request->all());

        if (!$coordination) {
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
            'message' => 'Error updating the coordination',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_coordination)
    {
        try {
            $this->coordinationBusiness->delete($id_coordination);
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
                'message' => 'Error deleting the coordination',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
