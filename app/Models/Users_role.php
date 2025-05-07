<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_role extends Model
{
    use HasFactory;

    protected $table = 'users_role';

    protected $primaryKey = 'id_user_role';

    public $timestamps = false;

    // Relación con el modelo 'Roles' (debe ser belongsTo porque un 'Users_role' pertenece a un 'Role')
    public function role()
    {
        return $this->belongsTo('App\Models\Roles', 'id_rol', 'id_rol');
    }

    // Relación con el modelo 'Users' (debe ser belongsTo porque un 'Users_role' pertenece a un 'User')
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'id_user', 'id_user');
    }
}