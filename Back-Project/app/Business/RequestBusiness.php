<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Services\RequestServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/*contiene la lógica de negocio de la aplicación*/

class RequestBusiness{
    protected $requestServices;

    public function __construct(RequestServices $requestServices)
    {
        $this->requestServices = $requestServices;
    }
    public function getAll()
    {
        return $this->requestServices->getAll();
    }

    public function getById($id_request)
    {
        $requests = $this->requestServices->getById($id_request);
        if (!$requests) {
            throw new \Exception('not found');
        }
        return $requests;
    }

    // CREAR
    public function create(array $data)
{
    // Validación personalizada o lógica adicional
    $validator = Validator::make($data, [
        'quota' => 'required|integer',
        'course_id' => 'required|integer',
        'category_id' => 'required|integer',
        'state_request' => 'nullable|boolean', // Asegurarse de que `state_request` se trate como un booleano o null
    ]);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    // Asegúrate de que `state_request` se convierta a `null` si está vacío
    if (!isset($data['state_request']) || $data['state_request'] === '') {
        $data['state_request'] = null; // Asignar `null` si está vacío o no está presente
    }

    return $this->requestServices->create($data);
}

    
    // ACTUALIZAR
    public function update($id_request, array $data)
    {
        // Verificar existencia y permisos
        $requests = $this->requestServices->getById($id_request);
    
        if (!$requests) {
            throw new NotFoundException('not found');
        }
    
        $validator = Validator::make($data, [
            'state_request' => 'nullable|boolean',  // Permitir null y validar como booleano
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        // Asegúrate de que `state_request` se convierta a `null` si está vacío
        if (!isset($data['state_request']) || $data['state_request'] === '') {
            $data['state_request'] = null;
        }
    
        return $this->requestServices->update($id_request, $data);
    }
    

    // ELIMINAR
    public function delete($id_request)
    {
        
    $requests = $this->requestServices->getById($id_request);
    
    if (!$requests) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->requestServices->delete($id_request);
    }
}