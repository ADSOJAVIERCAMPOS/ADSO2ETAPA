<?php

namespace App\DAO;

use App\Models\Specializations;

/*Interactua con la bases de Datos directamente*/

class SpecializationDAO{
    public function getAll()
    {
        return Specializations::all();
    }
    public function getById($id_specializations)
    {
        return Specializations::find($id_specializations);
    }
    public function create(array $data)
    {
        return Specializations::create($data);
    }
    public function update($id_specializations, array $data)
    {
        $specialization= Specializations::find($id_specializations);
        if ($specialization) {
            $specialization->update($data);
        }
        return $specialization;
    }
    public function delete($id_specializations)
    {
        $specialization = Specializations::find($id_specializations);
        if ($specialization) {
            $specialization->delete();
        }
        return $specialization;
    }  
}