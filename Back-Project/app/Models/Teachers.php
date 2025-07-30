<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;
    protected $table = 'teachers';

    // Relación uno a muchos con Specializations
    public function specializations()
    {
        return $this->hasMany(Specializations::class, 'teacher_id', 'id_teacher');
    }

    // Relación uno a uno con People
    public function person()
    {
        return $this->belongsTo(Peoples::class, 'person_id', 'id_person');
    }

    // Relación uno a muchos con Requests
    public function requests()
    {
        return $this->hasMany(Requests::class, 'teacher_id', 'id_teacher');
    }

    
    // Configurar la clave primaria
    protected $primaryKey = 'id_teacher';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

        // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'specialization',
        'years_experience',
        'person_id',
    ];
    public $timestamps = false;   
    
    public function getSpecializationAttribute($value)
    {
        return ucfirst($value); 
    }
   
    public function setSpecializationAttribute($value)
    {
        $this->attributes['specialization'] = strtolower($value); 
    }
    public function getYearsExperienceAttribute($value)
    {
        return ucfirst($value); 
    }
   
    public function setYearsExperienceAttribute($value)
    {
        $this->attributes['years_experience'] = strtolower($value); 
    }

    public function getPersonIdAttribute($value)
    {
        return ucfirst($value); 
    }
   
    public function setPersonIdAttribute($value)
    {
        $this->attributes['person_id'] = strtolower($value); 
    }

}
