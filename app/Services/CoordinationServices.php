<?php
namespace App\Services;

use App\DAO\CoordinationDAO;

class CoordinationServices
{
    protected $coordinationDAO;
    //__construct inyecta
    public function __construct(CoordinationDAO $coordinationDAO)
    {
        $this->coordinationDAO = $coordinationDAO;
    }

    public function getAll()
    {
        return $this->coordinationDAO->getAll();
    }

    public function getById($id_coordination)
    {
        return $this->coordinationDAO->getById($id_coordination);
    }
    public function create(array $data)
    {
        return $this->coordinationDAO->create($data);
    }

    public function update($id_coordination, array $data)
    {
        return $this->coordinationDAO->update($id_coordination, $data);
    }

    public function delete($id_coordination)
    {
        return $this->coordinationDAO->delete($id_coordination);
    } 
    
}