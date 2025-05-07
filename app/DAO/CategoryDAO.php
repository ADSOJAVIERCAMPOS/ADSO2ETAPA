<?php

namespace App\DAO;

use App\Models\Categories;

/*Interactua con la bases de Datos directamente*/

class CategoryDAO{
    public function getAll()
    {
        return Categories::all();
    }
    public function getById($id_category)
    {
        return Categories::find($id_category);
    }
    public function create(array $data)
    {
        return Categories::create($data);
    }
    public function update($id_category, array $data)
    {
        $category= Categories::find($id_category);
        if ($category) {
            $category->update($data);
        }
        return $category;
    }
    public function delete($id_category)
    {
        $category = Categories::find($id_category);
        if ($category) {
            $category->delete();
        }
        return $category;
    }  
}