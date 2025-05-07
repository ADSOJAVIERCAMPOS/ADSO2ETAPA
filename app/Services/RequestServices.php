<?php
namespace App\Services;

use App\DAO\RequestDAO;

class RequestServices
{
    protected $requestDAO;
    //__construct inyecta
    public function __construct(RequestDAO $requestDAO)
    {
        $this->requestDAO = $requestDAO;
    }

    public function getAll()
    {
        return $this->requestDAO->getAll();
    }

    public function getById($id_request)
    {
        return $this->requestDAO->getById($id_request);
    }
    public function create(array $data)
    {
        return $this->requestDAO->create($data);
    }

    public function update($id_request, array $data)
    {
        return $this->requestDAO->update($id_request, $data);
    }

    public function delete($id_request)
    {
        return $this->requestDAO->delete($id_request);
    } 
    
}