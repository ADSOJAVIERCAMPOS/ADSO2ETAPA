<?php

namespace App\Http\Controllers;

use App\Business\Document_TypeBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Document_TypeController extends Controller
{
    protected $document_TypeBusiness;

    public function __construct(Document_TypeBusiness $document_TypeBusiness)
    {
        $this->document_TypeBusiness = $document_TypeBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $document_type = $this->document_TypeBusiness->getAll();
            return response()->json([
                'document_type' => $document_type,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining document type',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_document_type)
    {
        try {
            $document_type= $this->document_TypeBusiness->getById($id_document_type);
            return response()->json([
                'document_type' => $document_type,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining document type',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
            'name_type' => 'required|unique:documents_type', 
            'acronym' => 'required',
            'description' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $document_type = $this->document_TypeBusiness->create($request->all());
    
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
                'message' => 'Error creating the document type',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualizar
    public function update(Request $request, $id_document_type)
{
    try {

        $validator = Validator::make($request->all(), [
            'name_type' => 'required|unique:documents_type,name,'. $id_document_type.',id_document_type', 
            'acronym' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $document_type = $this->document_TypeBusiness->update($id_document_type, $request->all());

        if (!$document_type) {
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
            'message' => 'Error updating the document type',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_document_type)
    {
        try {
            $this->document_TypeBusiness->delete($id_document_type);
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
                'message' => 'Error deleting the document type',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    } 
}