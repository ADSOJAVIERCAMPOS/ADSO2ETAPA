<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\SpecializationServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/*contiene la lógica de negocio de la aplicación*/

class SpecializationBusiness{
    protected $specializationServices;

    public function __construct(SpecializationServices $specializationServices)
    {
        $this->specializationServices = $specializationServices;
    }
    public function getAll()
    {
        return $this->specializationServices->getAll();
    }

    public function getById($id_specializations)
    {
        $specialization = $this->specializationServices->getById($id_specializations);
        if (!$specialization) {
            throw new \Exception('not found');
        }
        return $specialization;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'name_specialization' => 'required|unique:specializations',
            'teacher_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->specializationServices->create($data);
    
    }
    public function update($id_specializations, array $data)
    {
        // Verificar existencia y permisos
        $specialization = $this->specializationServices->getById($id_specializations);
    
        if (!$specialization) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'name_specialization' => 'required|unique:specializations,name_specialization,'. $id_specializations.',id_specializations',
            'teacher_id' => 'required'
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->specializationServices->update($id_specializations, $data);
    }
    
    public function delete($id_specializations)
    {
        
    $specialization = $this->specializationServices->getById($id_specializations);
    
    if (!$specialization) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->specializationServices->delete($id_specializations);
    }
}