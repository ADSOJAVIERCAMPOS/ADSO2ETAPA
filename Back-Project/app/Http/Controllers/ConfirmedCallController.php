<?php
namespace App\Http\Controllers;

use App\Mail\RegisterConfirmed;
use App\Models\Peoples;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfirmedCallController extends Controller
{public function sendEmail(Request $request)
    {
        // Validar los datos del request
        $validated = $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'course_id' => 'required|integer|exists:courses,id_course',
        ]);
    
        // Crear el registro de la persona
        $people = Peoples::create([
            'name' => $validated['name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'course_id' => $validated['course_id'],
        ]);
    
        // Obtener el curso asociado utilizando la relación
        $course = $people->course;
    
        // Verificar que el curso exista
        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }
    
        // Construir el array de datos para el correo
        $data = [
            'name' => $people->name,
            'last_name' => $people->last_name,
            'id_course' => $course->id_course,
            'name_course' => $course->name_course,
        ];
    
        // Enviar correo de confirmación
        Mail::to($people->email)->send(new RegisterConfirmed($data));
    
        // Responder con los datos (opcional)
        return response()->json([
            'name' => $people->name,
            'last_name' => $people->last_name,
            'id_course' => $course->id_course,
            'name_course' => $course->name_course,
        ], 200);
    }
    
}
