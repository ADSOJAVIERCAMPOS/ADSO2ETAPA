<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->hasMany(Peoples::class, 'country_id', 'id_country');
    }
    protected $table = 'countries';

    // Configurar la clave primaria
    protected $primaryKey = 'id_country';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

        // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'name_country',
        'city',
        'departament',
        'location_geography'
    ];
 
    public $timestamps = false;   
    
    public function getNameCountryAttribute($value)
    {
        return ucfirst($value); 
    }
    public function setNameCountryAttribute($value)
    {
        $this->attributes['name_country'] = strtolower($value); 
    }
     
     public function getCityAttribute($value)
     {
         return ucfirst($value); 
     }
      
     public function setCityAttribute($value)
     {
         $this->attributes['city'] = strtolower($value);
     }

     public function getDepartamentAttribute($value)
     {
         return ucfirst($value); 
     }
      
     public function setDepartamentAttribute($value)
     {
         $this->attributes['departament'] = strtolower($value);
     }

     public function getLocationGeographyAttribute($value)
     {
         return ucfirst($value); 
     }
      
     public function setLocationGeographyAttribute($value)
     {
         $this->attributes['location_geography'] = strtolower($value);
     }
    



}
