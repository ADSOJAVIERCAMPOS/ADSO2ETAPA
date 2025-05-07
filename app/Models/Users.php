<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Users extends Model implements JWTSubject, AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'users';

    // Configurar la clave primaria
    protected $primaryKey = 'id_user';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

    // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'password',
        'state_user',
        'person_id'
    ];

    // Relación uno a muchos con People
    public function person()
    {
        return $this->belongsTo(Peoples::class, 'person_id', 'id_person');
    }

    // Relación muchos a muchos con Roles
    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'role_user', 'user_id', 'role_id');
    }

    // Configuración de timestamps
    public $timestamps = true;

    // Métodos requeridos por JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        // Aquí puedes agregar más datos si los necesitas en el token
        return [];
    }

    // Métodos para modificar el estado y la contraseña (ya lo tenías)
    public function getPasswordAttribute($value)
    {
        return ucfirst($value);
    }
   
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = strtolower($value);
    }

    public function getStateUserAttribute($value)
    {
        return ucfirst($value);
    }

    public function setStateUserAttribute($value)
    {
        $this->attributes['state_user'] = strtolower($value);
    }

    public function getPersonIdAttribute($value)
    {
        return ucfirst($value);
    }

    public function setPersonIdAttribute($value)
    {
        $this->attributes['person_id'] = strtolower($value);
    }

    // Métodos requeridos por AuthenticatableContract
    public function getAuthIdentifierName()
    {
        return $this->primaryKey;
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->attributes[$this->getRememberTokenName()] ?? null;
    }

    public function setRememberToken($value)
    {
        $this->attributes[$this->getRememberTokenName()] = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
