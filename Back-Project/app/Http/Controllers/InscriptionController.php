<?php

namespace App\Http\Controllers;

use App\Business\InscriptionBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InscriptionController extends Controller
{
    protected $inscriptionBusiness;

    public function __construct(InscriptionBusiness $inscriptionBusiness)
    {
        $this->inscriptionBusiness = $inscriptionBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $inscriptions = $this->inscriptionBusiness->getAll();
            return response()->json([
                'inscriptions' => $inscriptions,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining inscription',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_register)
    {
        try {
            $register = $this->inscriptionBusiness->getById($id_register);
            return response()->json([
                'register' => $register,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining register',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'state_register' => 'required|unique:inscriptions|max:255', 
                'date_register' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $register = $this->inscriptionBusiness->create($request->all());
    
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
                'message' => 'Error creating the register',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualizar
    public function update(Request $request, $id_register)
{
    try {

        $validator = Validator::make($request->all(), [
            'state_register' => 'required|unique:inscription|max:255', 
            'date_register' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $register = $this->inscriptionBusiness->update($id_register, $request->all());

        if (!$register) {
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
            'message' => 'Error updating the regoister',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_register)
    {
        try {
            $this->inscriptionBusiness->delete($id_register);
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
                'message' => 'Error deleting the register',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    } 
}
