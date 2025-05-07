<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\StudentServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentBusiness
{
    protected $studentServices;

    public function __construct(StudentServices $studentServices)
    {
        $this->studentServices = $studentServices;
    }
    public function getAll()
    {
        return $this->studentServices->getAll();
    }

    public function getById($id_student)
    {
        $student = $this->studentServices->getById($id_student);
        if (!$student) {
            throw new \Exception('not found');
        }
        return $student;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'state_student' => 'required|unique:students',
            'person_id' => 'required' 
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->studentServices->create($data);
    
    }
    public function update($id_student, array $data)
    {
        // Verificar existencia y permisos
        $student = $this->studentServices->getById($id_student);
    
        if (!$student) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'state_student' => 'required|unique:students,state_student,'. $id_student.',id_student',
            'person_id' => 'required'
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->studentServices->update($id_student, $data);
    }
    
    public function delete($id_student)
    {
    $student = $this->studentServices->getById($id_student);    
    if (!$student) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->studentServices->delete($id_student);
    }
}