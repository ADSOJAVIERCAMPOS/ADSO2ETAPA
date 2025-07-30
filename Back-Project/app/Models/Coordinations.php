<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinations extends Model
{
    use HasFactory;

     // Relación inversa con People
     public function person()
     {
         return $this->belongsTo(Peoples::class, 'person_id', 'id_person');
     }
     
     // Relación uno a muchos con Schedules
     public function schedules()
     {
         return $this->hasMany(Schedules::class, 'coordination_id', 'id_coordination');
     }
    use HasFactory;
    protected $table = 'coordinations';

    
    // Configurar la clave primaria
    protected $primaryKey = 'id_coordination';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

        // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'area',
    ];
 
    public $timestamps = false;   
    
    public function getDocumentNumberAttribute($value)
    {
        return ucfirst($value); 
    }
    public function setDocumentNumberAttribute($value)
    {
        $this->attributes['document_number'] = strtolower($value); 
    }
}
