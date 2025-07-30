<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;
    protected $table = 'requests';

    // Definir las relaciones
    public function coordination()
    {
        return $this->belongsTo(Coordinations::class, 'coordination_id', 'id_coordination');
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_id', 'id_teacher');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id_course');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id_category');
    }

    // Configurar la clave primaria
    protected $primaryKey = 'id_request';
    public $incrementing = true;
    protected $keyType = 'int';

    // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'start_date',
        'end_date',
        'quota',
        'state_request',
        'course_id',
        'category_id',
    ];

    public $timestamps = false;

    // Mutadores y accesores ajustados para evitar conversiones incorrectas

    // Convertir las fechas a su formato correcto (evitar 'strtolower' o 'ucfirst' en fechas)
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value && $value !== '' ? date('Y-m-d', strtotime($value)) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value && $value !== '' ? date('Y-m-d', strtotime($value)) : null;
    }

    // Convertir el valor de 'quota' a un entero, para evitar errores en la base de datos
    public function setQuotaAttribute($value)
    {
        $this->attributes['quota'] = intval($value);
    }

    // Convertir 'state_request' a un booleano (true, false o null)
    public function setStateRequestAttribute($value)
    {
        if ($value === '' || is_null($value)) {
            $this->attributes['state_request'] = null; // Si es cadena vacía o nulo, establecer en null
        } else {
            $this->attributes['state_request'] = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }
    }

    // Accesores ajustados para devolver los valores en el formato adecuado
    public function getStateRequestAttribute($value)
    {
        return $value === null ? null : (bool) $value; // Devolver como booleano
    }

    public function getStartDateAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null; // Devolver formato de fecha
    }

    public function getEndDateAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null; // Devolver formato de fecha
    }

    public function getQuotaAttribute($value)
    {
        return (int) $value; // Devolver el valor como entero
    }

    public function getCourseIdAttribute($value)
    {
        return (int) $value; // Devolver el valor como entero
    }

    public function getCategoryIdAttribute($value)
    {
        return (int) $value; // Devolver el valor como entero
    }
}
