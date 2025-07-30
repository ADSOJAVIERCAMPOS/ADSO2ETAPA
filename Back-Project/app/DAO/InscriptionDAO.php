<?php

namespace App\DAO;

use App\Models\Inscription;

/*Interactua con la bases de Datos directamente*/

class InscriptionDAO{
    public function getAll()
    {
        return Inscription::all();
    }
    public function getById($id_register)
    {
        return Inscription::find($id_register);
    }
    public function create(array $data)
    {
        return Inscription::create($data);
    }
    public function update($id_register, array $data)
    {
        $register= Inscription::find($id_register);
        if ($register) {
            $register->update($data);
        }
        return $register;
    }
    public function delete($id_register)
    {
        $register = Inscription::find($id_register);
        if ($register) {
            $register->delete();
        }
        return $register;
    }  
}