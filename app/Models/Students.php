<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    //relacion uno a muchos
    public function inscription(){
        return $this ->belongsTo('App\Models\Inscription');

    }
    // Relación inversa con People
    public function person()
    {
        return $this->belongsTo(Peoples::class, 'person_id', 'id_person');
    }

    protected $table = 'students';

     // Configurar la clave primaria
     protected $primaryKey = 'id_student';

     // No usar incrementing para el campo primario si no es auto-incremental
     public $incrementing = true;
 
     // Tipo de la clave primaria (por defecto es 'int')
     protected $keyType = 'int';
 
         // Especificar los campos que se pueden asignar masivamente
     protected $fillable = [
         'state_student',
         'person_id', 
     ];
  
     public $timestamps = false;   
     
     public function getStateStudentAttribute($value)
     {
         return ucfirst($value); 
     }
     public function setStateStudentAttribute($value)
     {
         $this->attributes['state_student'] = strtolower($value); 
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
