<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\UserServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/*contiene la lógica de negocio de la aplicación*/

class UserBusiness{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }
    public function getAll()
    {
        return $this->userServices->getAll();
    }

    public function getById($id_user)
    {
        $user = $this->userServices->getById($id_user);
        if (!$user) {
            throw new \Exception('not found');
        }
        return $user;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'password' => 'required|unique:users', 
            'state_user' => 'required',
            'person_id' => 'required'
            
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->userServices->create($data);
    
    }
    
    public function update($id_user, array $data)
    {
        // Verificar existencia y permisos
        $user = $this->userServices->getById($id_user);
    
        if (!$user) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'password' => 'required|unique:users,password,'. $id_user.',id_user',
            'state_user' => 'required',
            'person_id' => 'required'
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->userServices->update($id_user, $data);
    }
    
    public function delete($id_user)
    {
        
    $user = $this->userServices->getById($id_user);
    
    if (!$user) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->userServices->delete($id_user);
    }
}