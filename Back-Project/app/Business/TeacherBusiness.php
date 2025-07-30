<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\TeacherServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/*contiene la lógica de negocio de la aplicación*/

class TeacherBusiness{
    protected $teacherServices;

    public function __construct(TeacherServices $teacherServices)
    {
        $this->teacherServices = $teacherServices;
    }
    public function getAll()
    {
        return $this->teacherServices->getAll();
    }

    public function getById($id_teacher)
    {
        $teacher = $this->teacherServices->getById($id_teacher);
        if (!$teacher) {
            throw new \Exception('not found');
        }
        return $teacher;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'specialization' => 'required|unique:teachers', 
            'years_experience' => 'required',
            'person_id' => 'required'
            
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->teacherServices->create($data);
    
    }
    public function update($id_teacher, array $data)
    {
        // Verificar existencia y permisos
        $teacher = $this->teacherServices->getById($id_teacher);
    
        if (!$teacher) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'specialization' => 'required|unique:teachers,specialization,'. $id_teacher.',id_teacher',
            'years_experience' => 'required',
            'person_id' => 'required'
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->teacherServices->update($id_teacher, $data);
    }
    
    public function delete($id_teacher)
    {
        
    $teacher = $this->teacherServices->getById($id_teacher);
    
    if (!$teacher) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->teacherServices->delete($id_teacher);
    }
}