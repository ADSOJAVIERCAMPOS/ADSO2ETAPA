<?php
namespace App\Services;

use App\DAO\UserDAO;

class UserServices
{
    protected $userDAO;
    //__construct inyecta
    public function __construct(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

    public function getAll()
    {
        return $this->userDAO->getAll();
    }

    public function getById($id_user)
    {
        return $this->userDAO->getById($id_user);
    }
    public function create(array $data)
    {
        return $this->userDAO->create($data);
    }

    public function update($id_user, array $data)
    {
        return $this->userDAO->update($id_user, $data);
    }

    public function delete($id_user)
    {
        return $this->userDAO->delete($id_user);
    } 
    
}