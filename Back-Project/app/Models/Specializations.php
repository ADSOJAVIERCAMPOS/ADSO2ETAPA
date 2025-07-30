<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specializations extends Model
{
    use HasFactory;
    protected $table = 'specializations';

    // Relación inversa con Teacher
    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'id_teacher');
    }

    
    // Configurar la clave primaria
    protected $primaryKey = 'id_specializations';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

        // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'name_specialization',
        'teacher_id',
    ];
    public $timestamps = false;   
    
    public function getNameSpecializationAttribute($value)
    {
        return ucfirst($value); 
    }
   
    public function setNameSpecializationAttribute($value)
    {
        $this->attributes['name_specialization'] = strtolower($value); 
    }

    public function getTeacherIdAttribute($value)
    {
        return ucfirst($value); 
    }
   
    public function setTeacherIdAttribute($value)
    {
        $this->attributes['teacher_id'] = strtolower($value); 
    }


    
}
