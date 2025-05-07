<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Peoples extends Model
{
    use HasFactory;

    protected $table = 'peoples';

   
    // Configurar la clave primaria
    protected $primaryKey = 'id_person';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

    // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'document_number',
        'permission',
        'date_birth',
        'address',
        'country_id',
        'document_type_id',
        'course_id',
    ];

    // Configuración de timestamps
    public $timestamps = true;

 public function user()
    {
        return $this->hasOne(Users::class, 'person_id', 'id_person');
    }
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id', 'id_country');
    }

    public function documentType()
    {
        return $this->belongsTo(Documents_Types::class, 'document_type_id', 'id_document_type');
    }

    public function student()
    {
        return $this->hasOne(Students::class, 'person_id', 'id_person');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'person_id', 'id_person');
    }

    public function coordination()
    {
        return $this->hasOne(Coordinations::class, 'person_id', 'id_person');
    }

    public function teacher()
    {
        return $this->hasOne(Teachers::class, 'person_id', 'id_person');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id_course');
    }
   

    // Accessor(get) para 'name' attribute
    public function getNameAttribute($value)
    {
        return ucfirst($value); // Capitaliza la primera letra del nombre
    }

    // Mutator(set) para 'name' attribute
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value); // Convierte el nombre a minúsculas
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtolower($value);
    }

    public function getEmailAttribute($value)
    {
        return ucfirst($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function getPhoneAttribute($value)
    {
        return ucfirst($value);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = strtolower($value);
    }
    public function getDocumentNumberAttribute($value)
    {
        return ucfirst($value);
    }

    public function setDocumentNumberAttribute($value)
    {
        $this->attributes['document_number'] = strtolower($value);
    }
    public function getDateBirthAttribute($value)
    {
        return ucfirst($value);
    }

    public function setDateBirthAttribute($value)
    {
        $this->attributes['date_birth'] = strtolower($value);
    }

    public function getPermissionAttribute($value)
    {
        return ucfirst($value);
    }
    public function setPermissionAttribute($value)
    {
        $this->attributes['permission'] = strtolower($value);
    }


    public function getAddressAttribute($value)
    {
        return ucfirst($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = strtolower($value);
    }

    public function getCountryIdAttribute($value)
    {
        return ucfirst($value);
    }

    public function setCountryIdAttribute($value)
    {
        $this->attributes['country_id'] = strtolower($value);
    }

    public function getDocumentTypeIdAttribute($value)
    {
        return ucfirst($value);
    }

    public function setDocumentTypeIdAttribute($value)
    {
        $this->attributes['document_type_id'] = strtolower($value);
    }

    public function getCourseIdAtribute($value)
    {
        return ucfirst($value);
    }

    public function setCourseIdAtribute($value)
    {
        $this->attributes['course_id'] = strtolower($value);
    }

    public function getRolIdAtribute($value)
    {
        return ucfirst($value);
    }

}
