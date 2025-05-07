<?php
namespace App\Services;

use App\DAO\Document_TypeDAO;

class Document_TypeServices
{
    protected $document_typeDAO;
    //__construct inyecta
    public function __construct(Document_TypeDAO $document_typeDAO)
    {
        $this->document_typeDAO = $document_typeDAO;
    }

    public function getAll()
    {
        return $this->document_typeDAO->getAll();
    }

    public function getById($id_document_type)
    {
        return $this->document_typeDAO->getById($id_document_type);
    }
    public function create(array $data)
    {
        return $this->document_typeDAO->create($data);
    }

    public function update($id_document_type, array $data)
    {
        return $this->document_typeDAO->update($id_document_type, $data);
    }

    public function delete($id_document_type)
    {
        return $this->document_typeDAO->delete($id_document_type);
    } 
    
}