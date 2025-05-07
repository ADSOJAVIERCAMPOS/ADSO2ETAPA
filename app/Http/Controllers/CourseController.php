<?php

namespace App\Http\Controllers;

use App\Business\CourseBusiness;
use App\Exceptions\NotFoundException;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    protected $courseBusiness;

    public function __construct(CourseBusiness $courseBusiness)
    {
        $this->courseBusiness = $courseBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $courses = $this->courseBusiness->getAll();
            return response()->json([
                'courses' => $courses,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining course',
                'status' => 500
            ], 500);
        }
    }
    //mostrar los cursos
    public function showCourses()
{
    $courses = Courses::all();
    return view('courses.index', compact('courses'));
}
    // Muestra en especifico con el id
    public function show($id_course)
    {
        try {
            $course = $this->courseBusiness->getById($id_course);
            return response()->json([
                'course' => $course,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining course',
                'status' => 500
            ], 500);
        }
    }

    public function store(Request $request)
{
    $request->validate([
        'name_course' => 'required|string|max:255',
        'description_course' => 'required|string',
        'acronym' => 'required|string|max:10',
        'state_course' => 'required|in:activo,inactivo', // Verifica este campo
        'category_id' => 'required|exists:categories,id_category',
    ]);
    try {
        $course = Courses::create([
            'name_course' => $request->name_course,
            'description_course' => $request->description_course,
            'acronym' => $request->acronym,
            'state_course' => $request->state_course,
            'category_id' => $request->category_id,
        ]);

        return response()->json($course, 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error creating course: ' . $e->getMessage()], 500);
    }
}

    
    /* public function massUpload(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,xlsx,xls',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        } 

        return response()->json([
            'message' => 'Cursos cargados correctamente',
            'status' => 200
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error cargando los cursos',
            'status' => 500,
            'error' => $e->getMessage()
        ], 500);
    }
} */
    //Actualizar
    public function update(Request $request, $id_course)
{
    try {

        $validator = Validator::make($request->all(), [ 
            'state_course' => 'required|unique:courses|max:255', 
     
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $course = $this->courseBusiness->update($id_course, $request->all());

        if (!$course) {
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
            'message' => 'Error updating the course',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_course)
    {
        try {
            $this->courseBusiness->delete($id_course);
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
                'message' => 'Error deleting the course',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
