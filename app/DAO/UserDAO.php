<?php

namespace App\DAO;

use App\Models\Users;

/*Interactua con la bases de Datos directamente*/

class UserDAO{
    public function getAll()
    {
        return Users::all();
    }
    public function getById($id_user)
    {
        return Users::find($id_user);
    }
    public function create(array $data)
    {
        return Users::create($data);
    }
    public function update($id_user, array $data)
    {
        $user= Users::find($id_user);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }
    public function delete($id_user)
    {
        $user = Users::find($id_user);
        if ($user) {
            $user->delete();
        }
        return $user;
    }  
}