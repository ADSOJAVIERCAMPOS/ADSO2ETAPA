<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;
    protected $table = 'inscriptions';

      // Relación inversa con Students

      public function students(){
        return $this->belongsTo('App\Models\Students');
    }

    // Relación inversa con Courses

    public function courses(){
        return $this->belongsTo('App\Models\Courses');
    }

    // Relación inversa con Schedules

    public function schedules(){
        return $this->belongsTo('App\Models\Schedules');
    }

    // Relación inversa con People
    public function person()
    {
        return $this->belongsTo(Peoples::class, 'person_id', 'id_person');
    }

    
    // Configurar la clave primaria
    protected $primaryKey = 'id_register';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

        // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'state_register',
        'date_register',
    ];
 
    public $timestamps = false;   
    
    public function getStateRegisterAttribute($value)
    {
        return ucfirst($value); 
    }
    public function setStateRegisterAttribute($value)
    {
        $this->attributes['state_register'] = strtolower($value); 
    }
     
     public function getDateRegisterAttribute($value)
     {
         return ucfirst($value); 
     }
      
     public function setDateRegisterAttribute($value)
     {
         $this->attributes['date_register'] = strtolower($value);
     }
    
}
