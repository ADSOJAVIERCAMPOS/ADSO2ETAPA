<?php
namespace App\Http\Controllers;

use App\Mail\confirmedInscriptionMail;
use App\Models\Peoples;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfirmedInscriptionController extends Controller
{public function sendinscription(Request $request)
    {
        // Validar los datos del request
        $validated = $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
        ]);
        
        // Crear o encontrar el registro de la persona
        $people = Peoples::updateOrCreate([
            'email' => $validated['email']
        ], [
            'name' => $validated['name'],
            'last_name' => $validated['last_name']
        ]);
        
        // Obtener el curso asociado
        $course = $people->course;
    
        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }
    
        // Preparar los datos para el correo
        $data = [
            'name' => $people->name,
            'last_name' => $people->last_name,
            'name_course' => $course->name_course,
        ];
    
        try {
            Mail::to($people->email)->send(new confirmedInscriptionMail($data));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al enviar el correo: ' . $e->getMessage()], 500);
        }
        
        return response()->json(['message' => 'Correo enviado correctamente.'], 200);
    }
    
}
    