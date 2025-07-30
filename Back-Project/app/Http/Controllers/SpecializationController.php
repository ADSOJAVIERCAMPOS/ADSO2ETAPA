<?php

namespace App\Http\Controllers;

use App\Business\SpecializationBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SpecializationController extends Controller
{
    protected $specializationBusiness;

    public function __construct(SpecializationBusiness $specializationBusiness)
    {
        $this->specializationBusiness = $specializationBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $specializations = $this->specializationBusiness->getAll();
            return response()->json([
                'specializations' => $specializations,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining specialization',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_specializations)
    {
        try {
            $specialization = $this->specializationBusiness->getById($id_specializations);
            return response()->json([
                'specialization' => $specialization,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining specialization',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name_specialization' => 'required|unique:specializations|max:255', 
                'teacher_id'=> 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $specialization = $this->specializationBusiness->create($request->all());
    
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
                'message' => 'Error creating the specialization',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualizar
    public function update(Request $request, $id_specializations)
{
    try {

        $validator = Validator::make($request->all(), [
            'name_specialization' => 'required|unique:specializations|max:255',
            'teacher_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $specialization = $this->specializationBusiness->update($id_specializations, $request->all());

        if (!$specialization) {
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
            'message' => 'Error updating the specialization',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_specializations)
    {
        try {
            $this->specializationBusiness->delete($id_specializations);
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
                'message' => 'Error deleting the specialization',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
 
}
}
