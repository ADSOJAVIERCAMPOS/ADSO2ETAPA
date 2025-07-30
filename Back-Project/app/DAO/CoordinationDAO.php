<?php

namespace App\DAO;

use App\Models\Coordinations;

/*Interactua con la bases de Datos directamente*/

class CoordinationDAO{
    public function getAll()
    {
        return Coordinations::all();
    }
    public function getById($id_coordination)
    {
        return Coordinations::find($id_coordination);
    }
    public function create(array $data)
    {
        return Coordinations::create($data);
    }
    public function update($id_coordination, array $data)
    {
        $coordination= Coordinations::find($id_coordination);
        if ($coordination) {
            $coordination->update($data);
        }
        return $coordination;
    }
    public function delete($id_coordination)
    {
        $coordination = Coordinations::find($id_coordination);
        if ($coordination) {
            $coordination->delete();
        }
        return $coordination;
    }  
}