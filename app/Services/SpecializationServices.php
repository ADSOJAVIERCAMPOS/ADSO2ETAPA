<?php
namespace App\Services;

use App\DAO\SpecializationDAO;

class SpecializationServices
{
    protected $specializationDAO;
    //__construct inyecta
    public function __construct(SpecializationDAO $specializationDAO)
    {
        $this->specializationDAO = $specializationDAO;
    }

    public function getAll()
    {
        return $this->specializationDAO->getAll();
    }

    public function getById($id_specializations)
    {
        return $this->specializationDAO->getById($id_specializations);
    }
    public function create(array $data)
    {
        return $this->specializationDAO->create($data);
    }

    public function update($id_specializations, array $data)
    {
        return $this->specializationDAO->update($id_specializations, $data);
    }

    public function delete($id_specializations)
    {
        return $this->specializationDAO->delete($id_specializations);
    } 
    
}