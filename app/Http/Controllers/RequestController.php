<?php

namespace App\Http\Controllers;

use App\Business\RequestBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RequestController extends Controller
{
    protected $requestBusiness;

    public function __construct(RequestBusiness $requestBusiness)
    {
        $this->requestBusiness = $requestBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $requests = $this->requestBusiness->getAll();
            return response()->json([
                'requests' => $requests,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining request',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_request)
    {
        try {
            $requests = $this->requestBusiness->getById($id_request);
            return response()->json([
                'requests' => $requests,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining request',
                'status' => 500
            ], 500);
        }
    }

    public function store(Request $request)
{
    try {
        // Validar los datos de la solicitud
        $validator = Validator::make($request->all(), [
            'quota' => 'required|integer',
            'course_id' => 'required|integer',
            'category_id' => 'required|integer',
            'start_date' => 'nullable|date', // Validar como fecha si se proporciona
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Preparar los datos para guardar en la base de datos
        $requestData = $request->only(['quota', 'course_id', 'category_id', 'start_date', 'end_date', 'state_request']);

        // Si start_date o end_date están vacíos, establecer en `null`
        $requestData['start_date'] = empty($requestData['start_date']) ? null : $requestData['start_date'];
        $requestData['end_date'] = empty($requestData['end_date']) ? null : $requestData['end_date'];

        // Si state_request no está presente o es una cadena vacía, establecer en `null`
        if (!isset($requestData['state_request']) || $requestData['state_request'] === '') {
            $requestData['state_request'] = null;
        }

        // Crear la solicitud usando el negocio
        $this->requestBusiness->create($requestData);

        return response()->json([
            'message' => 'Successful creation',
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
            'message' => 'Error creating the request',
            'status' => 500,
            'error' => $e->getMessage()
        ], 500);
    }
}

public function update(Request $request, $id_request)
{
    try {
        $validator = Validator::make($request->all(), [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'state_request' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $existingRequest = $this->requestBusiness->getById($id_request);
        if (!$existingRequest) {
            throw new NotFoundException('Request not found');
        }

        $updateData = $request->only(['start_date', 'end_date', 'state_request']);

        // Asegurarse de que las fechas vacías se conviertan en `null`
        $updateData['start_date'] = empty($updateData['start_date']) ? null : $updateData['start_date'];
        $updateData['end_date'] = empty($updateData['end_date']) ? null : $updateData['end_date'];

        // Actualizar usando la lógica de negocio
        $updatedRequest = $this->requestBusiness->update($id_request, $updateData);

        return response()->json([
            'message' => 'Successful update',
            'status' => 200,
            'updated_request' => $updatedRequest
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
            'message' => 'Error updating the request',
            'status' => 500,
            'error' => $e->getMessage()
        ], 500);
    }
}


    
    //Eliminar 
    public function destroy($id_request)
    {
        try {
            $this->requestBusiness->delete($id_request);
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
                'message' => 'Error deleting the request',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
