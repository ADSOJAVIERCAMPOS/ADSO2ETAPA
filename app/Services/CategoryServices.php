<?php
namespace App\Services;

use App\DAO\CategoryDAO;

class CategoryServices
{
    protected $categoryDAO;
    //__construct inyecta
    public function __construct(CategoryDAO $categoryDAO)
    {
        $this->categoryDAO = $categoryDAO;
    }

    public function getAll()
    {
        return $this->categoryDAO->getAll();
    }

    public function getById($id_category)
    {
        return $this->categoryDAO->getById($id_category);
    }
    public function create(array $data)
    {
        return $this->categoryDAO->create($data);
    }

    public function update($id_category, array $data)
    {
        return $this->categoryDAO->update($id_category, $data);
    }

    public function delete($id_category)
    {
        return $this->categoryDAO->delete($id_category);
    } 
    
}