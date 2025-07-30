<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'name_rol',
        'description_rol',
    ];

    // Relación con los usuarios (un rol puede ser asignado a muchos usuarios)
    public function users()
    {
        return $this->hasMany('App\Models\Users_role', 'id_rol', 'id_rol');
    }

    // Configuración de timestamps
    public $timestamps = false;   

    // Accessor (get) para 'name_rol'
    public function getNameRolAttribute($value)
    {
        return ucfirst($value); // Capitaliza la primera letra del nombre
    }

    // Mutator (set) para 'name_rol'
    public function setNameRolAttribute($value)
    {
        $this->attributes['name_rol'] = strtolower($value); // Convierte el nombre a minúsculas
    } 
}
