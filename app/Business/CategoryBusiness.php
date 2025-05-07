<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\CategoryServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryBusiness
{
    protected $categoryServices;

    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices = $categoryServices;
    }
    public function getAll()
    {
        return $this->categoryServices->getAll();
    }

    public function getById($id_category)
    {
        $category = $this->categoryServices->getById($id_category);
        if (!$category) {
            throw new \Exception('not found');
        }
        return $category;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'name_category' => 'required|unique:categories', 
            'description_category' => 'required',

        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->categoryServices->create($data);
    
    }
    public function update($id_category, array $data)
    {
        // Verificar existencia y permisos
        $category = $this->categoryServices->getById($id_category);
    
        if (!$category) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'name_category' => 'required|unique:categories,name_course,'. $id_category.',id_category',
            'description_category' => 'required',
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->categoryServices->update($id_category, $data);
    }
    
    public function delete($id_category)
    {
    $category = $this->categoryServices->getById($id_category);
    
    if (!$category) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->categoryServices->delete($id_category);
    }
}