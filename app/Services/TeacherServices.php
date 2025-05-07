<?php
namespace App\Services;

use App\DAO\TeacherDAO;

class TeacherServices
{
    protected $teacherDAO;
    //__construct inyecta
    public function __construct(TeacherDAO $teacherDAO)
    {
        $this->teacherDAO = $teacherDAO;
    }

    public function getAll()
    {
        return $this->teacherDAO->getAll();
    }

    public function getById($id_teacher)
    {
        return $this->teacherDAO->getById($id_teacher);
    }
    public function create(array $data)
    {
        return $this->teacherDAO->create($data);
    }

    public function update($id_teacher, array $data)
    {
        return $this->teacherDAO->update($id_teacher, $data);
    }

    public function delete($id_teacher)
    {
        return $this->teacherDAO->delete($id_teacher);
    } 
    
}