<?php

namespace App\Http\Controllers;

use App\Business\TeacherBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    protected $teacherBusiness;

    public function __construct(TeacherBusiness $teacherBusiness)
    {
        $this->teacherBusiness = $teacherBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $teachers = $this->teacherBusiness->getAll();
            return response()->json([
                'teachers' => $teachers,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining teacher',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_teacher)
    {
        try {
            $teacher = $this->teacherBusiness->getById($id_teacher);
            return response()->json([
                'teacher' => $teacher,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining teacher',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'specialization' => 'required|unique:teachers|max:255', 
                'years_experience' => 'required',
                'person_id' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $teacher = $this->teacherBusiness->create($request->all());
    
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
                'message' => 'Error creating the teacher',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualizar
    public function update(Request $request, $id_teacher)
{
    try {

        $validator = Validator::make($request->all(), [
            'specialization' => 'required|unique:teachers|max:255', 
            'years_experience' => 'required',
            'person_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $teacher = $this->teacherBusiness->update($id_teacher, $request->all());

        if (!$teacher) {
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
            'message' => 'Error updating the teacher',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_teacher)
    {
        try {
            $this->teacherBusiness->delete($id_teacher);
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
                'message' => 'Error deleting the teacher',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
 
}
}
