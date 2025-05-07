<?php
namespace App\Services;

use App\DAO\StudentDAO;

class StudentServices
{
    protected $studentDAO;
    //__construct inyecta
    public function __construct(StudentDAO $studentDAO)
    {
        $this->studentDAO = $studentDAO;
    }

    public function getAll()
    {
        return $this->studentDAO->getAll();
    }

    public function getById($id_student)
    {
        return $this->studentDAO->getById($id_student);
    }
    public function create(array $data)
    {
        return $this->studentDAO->create($data);
    }

    public function update($id_student, array $data)
    {
        return $this->studentDAO->update($id_student, $data);
    }

    public function delete($id_student)
    {
        return $this->studentDAO->delete($id_student);
    } 
    
}