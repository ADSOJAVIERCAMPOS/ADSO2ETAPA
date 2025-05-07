<?php

namespace App\Services;

use App\DAO\RoleDAO;

class RoleServices
{
    protected $roleDAO;
    //__construct inyecta
    public function __construct(RoleDAO $roleDAO)
    {
        $this->roleDAO = $roleDAO;
    }

    public function getAllRoles()
    {
        return $this->roleDAO->getAllRoles();
    }

    public function getById($id_rol)
    {
        return $this->roleDAO->getById($id_rol);
    }
    public function create(array $data)
    {
        return $this->roleDAO->create($data);
    }

    public function update($id_rol, array $data)
    {
        return $this->roleDAO->update($id_rol, $data);
    }

    public function delete($id_rol)
    {
        return $this->roleDAO->delete($id_rol);
    }
}
