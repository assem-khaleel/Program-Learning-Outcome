<?php

namespace App\Models\Settings;

use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en','program_id','student_no'];


    /**
     *  the course sections belongs to student
     */
    public function CourseSections()
    {
        return $this->belongsToMany(CourseSection::class,'course_section_student','course_section_id','student_id');
    }

    public function assignements()
    {
        return $this->belongsToMany(Assignment::class,'assignment_student','assignment_id','student_id');
    }


    public function program(){
        return $this->belongsTo(Program::class);
    }

}
