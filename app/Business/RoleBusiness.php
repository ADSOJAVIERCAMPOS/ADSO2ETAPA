<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Validator;
use App\Services\RoleServices;
use Illuminate\Validation\ValidationException;

class RoleBusiness
{
    protected $roleServices;

    public function __construct(RoleServices $roleServices)
    {
        $this->roleServices = $roleServices;
    }

    public function getAllRoles()
    {
        return $this->roleServices->getAllRoles();
    }

    public function getById($id_rol)
    {
        $rol = $this->roleServices->getById($id_rol);
        if (!$rol) {
            throw new \Exception('Role not found');
        }
        return $rol;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'name_rol' => 'required|unique:roles',
            'description_rol' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->roleServices->create($data);
    
    }

    public function update($id_rol, array $data)
    {
        // Verificar existencia y permisos
        $rol = $this->roleServices->getById($id_rol);
    
        if (!$rol) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'name_rol' => 'required|unique:roles,name_rol,' . $id_rol.',id_rol',
            'description_rol' => 'required',
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->roleServices->update($id_rol, $data);
    }
    
    public function delete($id_rol)
    {
        // Verificar si el rol existe antes de intentar eliminarlo
    $role = $this->roleServices->getById($id_rol);
    
    if (!$role) {
        // Si el rol no existe, lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('Rol not found');
    }

        return $this->roleServices->delete($id_rol);
    }
}
