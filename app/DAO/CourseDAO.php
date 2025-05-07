<?php

namespace App\DAO;

use App\Models\Courses;

/*Interactua con la bases de Datos directamente*/

class CourseDAO{
    public function getAll()
    {
        return Courses::all();
    }
    public function getById($id_course)
    {
        return Courses::find($id_course);
    }
    public function create(array $data)
    {
        return Courses::create($data);
    }
    public function update($id_course, array $data)
    {
        $course= Courses::find($id_course);
        if ($course) {
            $course->update($data);
        }
        return $course;
    }
    public function delete($id_course)
    {
        $course = Courses::find($id_course);
        if ($course) {
            $course->delete();
        }
        return $course;
    }  
}