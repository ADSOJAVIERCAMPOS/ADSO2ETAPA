<?php

namespace App\DAO;

use App\Models\Roles;

class RoleDAO
{
    public function getAllRoles()
    {
        return Roles::all();
    }
    public function getById($id_rol)
    {
        return Roles::find($id_rol);
    }

    public function create(array $data)
    {
        return Roles::create($data);
    }

    public function update($id_rol, array $data)
    {
        $rol= Roles::find($id_rol);
        if ($rol) {
            $rol->update($data);
        }
        return $rol;
    }
    

    public function delete($id_rol)
    {
        $rol = Roles::find($id_rol);
        if ($rol) {
            $rol->delete();
        }
        return $rol;
    }
}
