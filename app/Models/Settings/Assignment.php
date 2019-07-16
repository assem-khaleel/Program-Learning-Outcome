<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;


class Assignment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar','course_id','description_en','description_ar','course_sections_id','created_by','published'];

    /**
     * @return string
     */
    public function getNameAttribute() {
        return App::getLocale() == 'ar' ? $this->name_en : $this->name_en;
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute() {
        return App::getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function courseSection(){
        return $this->belongsTo(CourseSection::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class,'assignment_student','student_id','assignment_id');
    }


}
