<?php

namespace App\DAO;

use App\Models\Teachers;

/*Interactua con la bases de Datos directamente*/

class TeacherDAO{
    public function getAll()
    {
        return Teachers::all();
    }
    public function getById($id_teacher)
    {
        return Teachers::find($id_teacher);
    }
    public function create(array $data)
    {
        return Teachers::create($data);
    }
    public function update($id_teacher, array $data)
    {
        $teacher= Teachers::find($id_teacher);
        if ($teacher) {
            $teacher->update($data);
        }
        return $teacher;
    }
    public function delete($id_teacher)
    {
        $teacher = Teachers::find($id_teacher);
        if ($teacher) {
            $teacher->delete();
        }
        return $teacher;
    }  
}