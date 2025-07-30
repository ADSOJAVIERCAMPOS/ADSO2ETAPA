<?php
namespace App\Services;

use App\DAO\InscriptionDAO;

class InscriptionServices
{
    protected $inscriptionDAO;
    //__construct inyecta
    public function __construct(InscriptionDAO $inscriptionDAO)
    {
        $this->inscriptionDAO = $inscriptionDAO;
    }

    public function getAll()
    {
        return $this->inscriptionDAO->getAll();
    }

    public function getById($id_register)
    {
        return $this->inscriptionDAO->getById($id_register);
    }
    public function create(array $data)
    {
        return $this->inscriptionDAO->create($data);
    }

    public function update($id_register, array $data)
    {
        return $this->inscriptionDAO->update($id_register, $data);
    }

    public function delete($id_register)
    {
        return $this->inscriptionDAO->delete($id_register);
    } 
    
}