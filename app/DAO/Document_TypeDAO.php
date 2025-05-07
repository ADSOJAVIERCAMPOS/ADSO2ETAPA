<?php

namespace App\DAO;

use App\Models\Documents_Types;

/*Interactua con la bases de Datos directamente*/

class Document_TypeDAO{
    public function getAll()
    {
        return Documents_Types::all();
    }
    public function getById($id_document_type)
    {
        return Documents_Types::find($id_document_type);
    }
    public function create(array $data)
    {
        return Documents_Types::create($data);
    }
    public function update($id_document_type, array $data)
    {
        $document_types= Documents_Types::find($id_document_type);
        if ($document_types) {
            $document_types->update($data);
        }
        return $document_types;
    }
    public function delete($id_document_type)
    {
        $document_types = Documents_Types::find($id_document_type);
        if ($document_types) {
            $document_types->delete();
        }
        return $document_types;
    }  
}