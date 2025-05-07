<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\PeopleServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PeopleBusiness
{
    protected $peopleServices;

    public function __construct(PeopleServices $peopleServices)
    {
        $this->peopleServices = $peopleServices;
    }

    public function getAll()
    {
        return $this->peopleServices->getAll();
    }

    public function getById($id_person)
    {
        $person = $this->peopleServices->getById($id_person);
        if (!$person) {
            throw new NotFoundException('Person not found');
        }
        return $person;
    }

    public function create(array $data)
    {
        // Validaciones básicas
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|string',
            'document_number' => 'nullable', 
            'permission' => 'nullable|string',
            'date_birth' => 'required|date',
            'address' => 'required',
            'country_id' => 'required|integer',
            'document_type_id' => 'nullable|integer', 
            'course_id'=>'nullable|integer'
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        // Validaciones condicionales
        if ($data['country_id'] == 1) { // Primer país
            $validator = Validator::make($data, [
                'document_type_id' => 'required|integer',
                'document_number' => 'required|string',
  
            ]);
         }
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
   
         // Validación de la edad
    $dateOfBirth = $data['date_birth'];
    $age = \Carbon\Carbon::parse($dateOfBirth)->age;

    if ($age < 14) {
        throw new ValidationException(Validator::make([], [
            'date_birth' => 'You must be at least 14 years old.',
        ]));
    }
        return $this->peopleServices->create($data);
    }
    
    public function update($id_person, array $data)
    {
        $person = $this->peopleServices->getById($id_person);

        if (!$person) {
            throw new NotFoundException('Person not found');
        }

        $validator = Validator::make($data, [
            'name' => 'required|peoples,name,' . $id_person . ',id_person|max:255',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|string',
            'document_number' => 'required',
            'permission' => 'nullable|string',  
            'date_birth' => 'required|date',
            'address' => 'required',
            'country_id' => 'required|integer',
            'document_type_id' => 'required|integer',
            'course_id'=>'required|integer'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

         // Validación de la edad
    $dateOfBirth = $data['date_birth'];
    $age = \Carbon\Carbon::parse($dateOfBirth)->age;

    if ($age < 14) {
        throw new ValidationException(Validator::make([], [
            'date_birth' => 'You must be at least 14 years old.',
        ]));
    }
        return $this->peopleServices->update($id_person, $data);
    }

    public function delete($id_person)
    {
        $person = $this->peopleServices->getById($id_person);

        if (!$person) {
            throw new NotFoundException('Person not found');
        }

        return $this->peopleServices->delete($id_person);
    }
}
