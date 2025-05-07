<?php
namespace App\Services;

use App\DAO\CourseDAO;

class CourseServices
{
    protected $courseDAO;
    //__construct inyecta
    public function __construct(CourseDAO $courseDAO)
    {
        $this->courseDAO = $courseDAO;
    }

    public function getAll()
    {
        return $this->courseDAO->getAll();
    }

    public function getById($id_course)
    {
        return $this->courseDAO->getById($id_course);
    }
    public function create(array $data)
    {
        return $this->courseDAO->create($data);
    }

    public function update($id_course, array $data)
    {
        return $this->courseDAO->update($id_course, $data);
    }

    public function delete($id_course)
    {
        return $this->courseDAO->delete($id_course);
    } 
    
}