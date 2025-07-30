<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents_Types extends Model
{
    use HasFactory;

    // Relación uno a muchos con People
    public function people()
    {
        return $this->hasMany(Peoples::class, 'document_type_id', 'id_document_type');
    }

    protected $table = 'documents_type';
    // Configurar la clave primaria
    protected $primaryKey = 'id_document_type';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

        // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'name_type',
        'acronym',
        'description'
    ];
 
    public $timestamps = false;   
    
    public function getNameTypeAttribute($value)
    {
        return ucfirst($value); 
    }
    public function setNameTypeAttribute($value)
    {
        $this->attributes['name_type'] = strtolower($value); 
    }
     
     public function getAcronymAttribute($value)
     {
         return ucfirst($value); 
     }
      
     public function setAcronymAttribute($value)
     {
         $this->attributes['acronym'] = strtolower($value);
     }

     public function getDescriptionAttribute($value)
     {
         return ucfirst($value); 
     }
      
     public function setDescriptionAttribute($value)
     {
         $this->attributes['description'] = strtolower($value);
     }

}
