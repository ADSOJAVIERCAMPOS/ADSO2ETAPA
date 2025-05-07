<?php

namespace App\Services;

use App\DAO\PeopleDAO;

class PeopleServices
{
    protected $peopleDAO;
    //__construct inyecta
    public function __construct(PeopleDAO $peopleDAO)
    {
        $this->peopleDAO = $peopleDAO;
    }

    public function getAll()
    {
        return $this->peopleDAO->getAll();
    }

    public function getById($id_person)
    {
        return $this->peopleDAO->getById($id_person);
    }
    public function create(array $data)
    {
        return $this->peopleDAO->create($data);
    }

    public function update($id_person, array $data)
    {
        return $this->peopleDAO->update($id_person, $data);
    }

    public function delete($id_person)
    {
        return $this->peopleDAO->delete($id_person);
    }
}