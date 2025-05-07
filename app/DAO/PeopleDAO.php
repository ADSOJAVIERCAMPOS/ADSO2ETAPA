<?php

namespace App\DAO;

use App\Models\Peoples;

/*Interactua con la bases de Datos directamente*/

class PeopleDAO{
    public function getAll()
    {
        return Peoples::all();
    }
    public function getById($id_person)
    {
        return Peoples::find($id_person);
    }
    public function create(array $data)
    {
        return Peoples::create($data);
    }
    public function update($id_person, array $data)
    {
        $person= Peoples::find($id_person);
        if ($person) {
            $person->update($data);
        }
        return $person;
    }
    public function delete($id_person)
    {
        $person = Peoples::find($id_person);
        if ($person) {
            $person->delete();
        }
        return $person;
    } 
}