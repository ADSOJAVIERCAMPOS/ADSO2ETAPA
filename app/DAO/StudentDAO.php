<?php

namespace App\DAO;

use App\Models\Students;

/*Interactua con la bases de Datos directamente*/

class StudentDAO{
    public function getAll()
    {
        return Students::all();
    }
    public function getById($id_student)
    {
        return Students::find($id_student);
    }
    public function create(array $data)
    {
        return Students::create($data);
    }
    public function update($id_student, array $data)
    {
        $student= Students::find($id_student);
        if ($student) {
            $student->update($data);
        }
        return $student;
    }
    public function delete($id_student)
    {
        $student = Students::find($id_student);
        if ($student) {
            $student->delete();
        }
        return $student;
    }  
}