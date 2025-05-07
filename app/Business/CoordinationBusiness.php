<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\CoordinationServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CoordinationBusiness
{
    protected $coordinationServices;

    public function __construct(CoordinationServices $coordinationServices)
    {
        $this->coordinationServices = $coordinationServices;
    }
    public function getAll()
    {
        return $this->coordinationServices->getAll();
    }

    public function getById($id_coordination)
    {
        $coordination = $this->coordinationServices->getById($id_coordination);
        if (!$coordination) {
            throw new \Exception('not found');
        }
        return $coordination;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'area' => 'required|unique:coordinations', 
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->coordinationServices->create($data);
    
    }
    public function update($id_coordination, array $data)
    {
        // Verificar existencia y permisos
        $coordination = $this->coordinationServices->getById($id_coordination);
    
        if (!$coordination) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'area' => 'required|unique:coordinations,area,'. $id_coordination.',id_coordination',

        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->coordinationServices->update($id_coordination, $data);
    }
    
    public function delete($id_coordination)
    {
    $coordination = $this->coordinationServices->getById($id_coordination);    
    if (!$coordination) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->coordinationServices->delete($id_coordination);
    }
}