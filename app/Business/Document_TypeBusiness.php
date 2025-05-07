<?php

namespace App\Business;

use App\Exceptions\NotFoundException;
use App\Models\Documents_Types;
use App\Services\Document_TypeServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Document_TypeBusiness
{
    protected $document_typeServices;

    public function __construct(Document_TypeServices $document_typeServices)
    {
        $this->document_typeServices = $document_typeServices;
    }
    public function getAll()
    {
        return $this->document_typeServices->getAll();
    }

    public function getById($id_document_type)
    {
        $document_type = $this->document_typeServices->getById($id_document_type);
        if (!$document_type) {
            throw new \Exception('not found');
        }
        return $document_type;
    }

    public function create(array $data)
    {
        // Validación personalizada o lógica adicional
        $validator = Validator::make($data, [
            'name_type' => 'required|unique:documents_type', 
            'acronym' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->document_typeServices->create($data);
    
    }
    public function update($id_document_type, array $data)
    {
        // Verificar existencia y permisos
        $document_type = $this->document_typeServices->getById($id_document_type);
    
        if (!$document_type) {
            return null;
        }
    
        $validator = Validator::make($data, [
            'name_type' => 'required|unique:documents_type,name,'. $id_document_type.',id_document_type', 
            'acronym' => 'required',
            'description' => 'required'
        ]);
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        return $this->document_typeServices->update($id_document_type, $data);
    }
    
    public function delete($id_document_type)
    {
    $document_type = $this->document_typeServices->getById($id_document_type);    
    if (!$document_type) {
        // lanzar una excepción o manejar el error según sea necesario
        throw new NotFoundException('not found');
    }

        return $this->document_typeServices->delete($id_document_type);
    }
}