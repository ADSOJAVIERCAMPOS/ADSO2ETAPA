<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\CourseServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CourseBusiness
{
    protected $courseServices;

    public function __construct(CourseServices $courseServices)
    {
        $this->courseServices = $courseServices;
    }
    public function getAll()
    {
        return $this->courseServices->getAll();
    }

    public function getById($id_course)
    {
        $course = $this->courseServices->getById($id_course);
        if (!$course) {
            throw new \Exception('not found');
        }
        return $course;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'name_course' => 'required|:courses', 
            'description_course' => 'required',
            'acronym'=> 'required',
            'state_course'=> 'required',
            'quota_course'=> 'required|integer',
            'category_id' => 'required|exists:categories,id'

        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->courseServices->create($data);
    
    }
    public function update($id_course, array $data)
{
    $course = $this->courseServices->getById($id_course);

    if (!$course) {
        return null;
    }

    $validator = Validator::make($data, [
        'state_course' => 'required|max:255|unique:courses,name_course,' . $id_course . ',id_course',


    ]);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    return $this->courseServices->update($id_course, $data);
}
    
    public function delete($id_course)
    {
    $course = $this->courseServices->getById($id_course);
    
    if (!$course) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->courseServices->delete($id_course);
    }
}