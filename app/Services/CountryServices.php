<?php
namespace App\Services;

use App\DAO\CountryDAO;

class CountryServices
{
    protected $countryDAO;
    //__construct inyecta
    public function __construct(CountryDAO $countryDAO)
    {
        $this->countryDAO = $countryDAO;
    }

    public function getAll()
    {
        return $this->countryDAO->getAll();
    }

    public function getById($id_country)
    {
        return $this->countryDAO->getById($id_country);
    }
    public function create(array $data)
    {
        return $this->countryDAO->create($data);
    }

    public function update($id_country, array $data)
    {
        return $this->countryDAO->update($id_country, $data);
    }

    public function delete($id_country)
    {
        return $this->countryDAO->delete($id_country);
    } 
    
}