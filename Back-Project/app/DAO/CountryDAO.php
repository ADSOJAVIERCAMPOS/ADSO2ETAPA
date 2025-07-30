<?php

namespace App\DAO;

use App\Models\Countries;

/*Interactua con la bases de Datos directamente*/

class CountryDAO{
    public function getAll()
    {
        return Countries::all();
    }
    public function getById($id_country)
    {
        return Countries::find($id_country);
    }
    public function create(array $data)
    {
        return Countries::create($data);
    }
    public function update($id_country, array $data)
    {
        $country= Countries::find($id_country);
        if ($country) {
            $country->update($data);
        }
        return $country;
    }
    public function delete($id_country)
    {
        $country = Countries::find($id_country);
        if ($country) {
            $country->delete();
        }
        return $country;
    }  
}