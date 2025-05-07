<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function courses(){
        return $this->hasMany(Courses::class, 'category_id', 'id_category');
    }

    public function request(){
        return $this->hasMany(Requests::class, 'category_id', 'id_category');
    }
    
    // Configurar la clave primaria
    protected $primaryKey = 'id_category';

    // No usar incrementing para el campo primario si no es auto-incremental
    public $incrementing = true;

    // Tipo de la clave primaria (por defecto es 'int')
    protected $keyType = 'int';

        // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'name_category',
        'description_category',
    ];
 
    // Configuración de timestamps
    public $timestamps = false;   
    

    // Accessor(get) para 'name' attribute
    public function getNameCategoryAttribute($value)
    {
        return ucfirst($value); // Capitaliza la primera letra del nombre
    }

    // Mutator(set) para 'name' attribute
    public function setNameCategoryAttribute($value)
    {
        $this->attributes['name_category'] = strtolower($value); // Convierte el nombre a minúsculas
    }
     
     public function getDescriptionCategoryAttribute($value)
     {
         return ucfirst($value); 
     }
      
     public function setDescriptionCategoryAttribute($value)
     {
         $this->attributes['description_category'] = strtolower($value);
     }
}
