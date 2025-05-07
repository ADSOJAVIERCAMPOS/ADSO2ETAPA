<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'id_course';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'name_course',
        'description_course',
        'acronym',
        'state_course',
        'quota_course',
        'category_id',
    ];

    // Relaciones
    public function inscription()
    {
        return $this->hasMany(Inscription::class, 'course_id', 'id_course');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id_category');
    }

    public function peoples()
    {
        return $this->hasMany(Peoples::class, 'course_id', ' id_course');
    }  

    public function request()
    {
        return $this->hasMany(Requests::class, 'course_id', 'id_course');
    }
    // Accessors and Mutators
    public function getNameCourseAttribute($value)
    {
        return ucfirst($value);
    }

    public function setNameCourseAttribute($value)
    {
        $this->attributes['name_course'] = strtolower($value);
    }

    public function getDescriptionCourseAttribute($value)
    {
        return ucfirst($value);
    }

    public function setDescriptionCourseAttribute($value)
    {
        $this->attributes['description_course'] = strtolower($value);
    }

    public function getAcronymAttribute($value)
    {
        return ucfirst($value);
    }

    public function setAcronymAttribute($value)
    {
        $this->attributes['acronym'] = strtolower($value);
    }

    public function getStateCourseAttribute($value)
    {
        return ucfirst($value);
    }

    public function setStateCourseAttribute($value)
    {
        $this->attributes['state_course'] = strtolower($value);
    }
    
    public function getQuotaCourseAttribute($value)
    {
        return $value; 
    }

    public function setQuotaCourseAttribute($value)
    {
        $this->attributes['quota_course'] = strtolower($value);
    }

    public function getCategoryIdAttribute($value)
    {
        return ucfirst($value);
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = strtolower($value);
    }

}
