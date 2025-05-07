<?php

namespace App\DAO;

use App\Models\Requests;

/*Interactua con la bases de Datos directamente*/

class RequestDAO{
    public function getAll()
    {
        return Requests::all();
    }
    public function getById($id_request)
    {
        return Requests::find($id_request);
    }
    public function create(array $data)
    {
        return Requests::create($data);
    }
    public function update($id_request, array $data)
    {
        $requests= Requests::find($id_request);
        if ($requests) {
            $requests->update($data);
        }
        return $requests;
    }
    public function delete($id_request)
    {
        $requests = Requests::find($id_request);
        if ($requests) {
            $requests->delete();
        }
        return $requests;
    }  
}