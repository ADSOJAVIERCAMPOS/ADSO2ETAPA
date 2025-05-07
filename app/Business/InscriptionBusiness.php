<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\InscriptionServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InscriptionBusiness
{
    protected $inscriptionServices;

    public function __construct(InscriptionServices $inscriptionServices)
    {
        $this->inscriptionServices = $inscriptionServices;
    }
    public function getAll()
    {
        return $this->inscriptionServices->getAll();
    }

    public function getById($id_register)
    {
        $register = $this->inscriptionServices->getById($id_register);
        if (!$register) {
            throw new \Exception('not found');
        }
        return $register;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'state_register' => 'required|unique:inscriptions', 
            'date_register' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->inscriptionServices->create($data);
    
    }
    public function update($id_register, array $data)
    {
        // Verificar existencia y permisos
        $register = $this->inscriptionServices->getById($id_register);
    
        if (!$register) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'state_register' => 'required|unique:inscriptions,state_register,'. $id_register.',id_register',
            'date_register' => 'required',
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->inscriptionServices->update($id_register, $data);
    }
    
    public function delete($id_register)
    {
    $register = $this->inscriptionServices->getById($id_register);    
    if (!$register) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->inscriptionServices->delete($id_register);
    }
}