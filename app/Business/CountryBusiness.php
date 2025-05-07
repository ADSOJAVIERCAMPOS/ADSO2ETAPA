<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Models\Countries;
use App\Services\CountryServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CountryBusiness
{
    protected $countryServices;

    public function __construct(CountryServices $countryServices)
    {
        $this->countryServices = $countryServices;
    }
    public function getAll()
    {
        return $this->countryServices->getAll();
    }

    public function getById($id_country)
    {
        $country = $this->countryServices->getById($id_country);
        if (!$country) {
            throw new \Exception('not found');
        }
        return $country;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'name_country' => 'required|unique:countries', 
            'city' => 'required',
            'departament'=> 'required',
            'location_geography' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->countryServices->create($data);
    
    }
    public function update($id_country, array $data)
    {
        // Verificar existencia y permisos
        $country = $this->countryServices->getById($id_country);
    
        if (!$country) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'name_country' => 'required|unique:countries,name_country,'. $id_country.',id_country',
            'city' => 'required',
            'departament'=> 'required',
            'location_geography' => 'required'
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->countryServices->update($id_country, $data);
    }
    
    public function delete($id_country)
    {
    $country = $this->countryServices->getById($id_country);    
    if (!$country) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->countryServices->delete($id_country);
    }
}