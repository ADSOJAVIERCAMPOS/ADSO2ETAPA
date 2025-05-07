<?php

namespace App\Http\Controllers;

use App\Business\PeopleBusiness;
use App\Exceptions\NotFoundException;
use App\Mail\RegisterConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PeopleController extends Controller
{
    protected $peopleBusiness;

    public function __construct(PeopleBusiness $peopleBusiness)
    {
        $this->peopleBusiness = $peopleBusiness;
    }

    public function index()
    {
        try {
            $peoples = $this->peopleBusiness->getAll();
            return response()->json([
                'peoples' => $peoples,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining persons',
                'status' => 500
            ], 500);
        }
    }

    public function show($id_person)
    {
        try {
            $person = $this->peopleBusiness->getById($id_person);
            return response()->json([
                'person' => $person,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining person',
                'status' => 500
            ], 500);
        }
    }

    public function store(Request $request)
{
    try {
        // Validaciones básicas
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|string',
            'document_number' => 'nullable',
            'permission' => 'nullable|string',
            'date_birth' => 'required|date',
            'address' => 'required',
            'country_id' => 'required|integer',
            'document_type_id' => 'nullable|integer',
            'course_id' => 'nullable|integer', // Mantenerlo opcional
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Validaciones condicionales según el país
        if ($request->country_id == 1) { // Primer país
            $validator = Validator::make($request->all(), [
                'document_type_id' => 'required|integer',
                'document_number' => 'required|string',
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Validación de la edad
        $dateOfBirth = $request->input('date_birth');
        $age = \Carbon\Carbon::parse($dateOfBirth)->age;

        if ($age < 14) {
            return response()->json([
                'message' => 'You must be at least 14 years old.',
                'status' => 400
            ], 400);
        }


        // Crear la persona
        $person = $this->peopleBusiness->create($request->all());

        // Si es un instructor, busca el curso asociado
        if ($request->filled('course_id')) {
            // Aquí se asume que 'course' está definido en el modelo People
            $course = $person->course; 

            if (!$course) {
                return response()->json([
                    'message' => 'Course not found',
                    'status' => 404
                ], 404);
            }

            // Construir el array de datos para el correo
            $data = [
                'name' => $person->name,
                'last_name' => $person->last_name,
                'id_course' => $course->id_course,
                'name_course' => $course->name_course,
            ];

            // Enviar correo de confirmación
            Mail::to($person->email)->send(new RegisterConfirmed($data));
        }

        return response()->json([
            'message' => 'Person created successfully',
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
            'message' => 'Error creating the person',
            'status' => 500,
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function update(Request $request, $id_person)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|peoples,name,' . $id_person . ',id_person|max:255',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|string',
                'document_number' => 'required',
                'permission' => 'nullable|string',
                'date_birth' => 'required|date',
                'address' => 'required',
                'country_id' => 'required|integer',
                'document_type_id' => 'required|integer',
                'course_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }

            $person = $this->peopleBusiness->update($id_person, $request->all());

            if (!$person) {
                throw new NotFoundException('Person not found');
            }

            return response()->json([
                'message' => 'Person updated successfully',
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
                'message' => 'Error updating the person',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id_person)
    {
        try {
            $this->peopleBusiness->delete($id_person);
            return response()->json([
                'message' => 'Person deleted successfully',
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the person',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
