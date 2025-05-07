<?php

namespace App\Http\Controllers;

use App\Business\CategoryBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    protected $categoryBusiness;

    public function __construct(CategoryBusiness $categoryBusiness)
    {
        $this->categoryBusiness = $categoryBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $categories = $this->categoryBusiness->getAll();
            return response()->json([
                'categories' => $categories,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining category',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_category)
    {
        try {
            $category = $this->categoryBusiness->getById($id_category);
            return response()->json([
                'category' => $category,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining category',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [ 
                'name_category' => 'required|unique:categories|max:255', 
                'description_category' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $category = $this->categoryBusiness->create($request->all());
    
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
                'message' => 'Error creating the category',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualizar
    public function update(Request $request, $id_category)
{
    try {

        $validator = Validator::make($request->all(), [
            'name_category' => 'required|unique:categories|max:255', 
            'description_category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $category = $this->categoryBusiness->update($id_category, $request->all());

        if (!$category) {
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
            'message' => 'Error updating the category',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_category)
    {
        try {
            $this->categoryBusiness->delete($id_category);
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
                'message' => 'Error deleting the category',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
