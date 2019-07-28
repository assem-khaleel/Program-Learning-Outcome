<?php

namespace App\Models\Settings;

use App\Models\AssessmentEvaluations;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Program;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Settings\Student
 *
 * @property int $id
 * @property string $name_en
 * @property int $program_id
 * @property int $student_no
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|\App\Models\Settings\CourseSection[] $CourseSections
 * @property-read Collection|AssessmentEvaluations[] $assigmentEvaluations
 * @property-read Collection|Assignment[] $assignments
 * @property-read \App\Models\Settings\Program $program
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStudentNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static Builder|Student withTrashed()
 * @method static Builder|Student withoutTrashed()
 * @mixin Eloquent
 */
class Student extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];

    protected $fillable = ['name_en','program_id','student_no'];


    /**
     *  the course sections belongs to student
     */
    public function CourseSections()
    {
        return $this->belongsToMany(CourseSection::class,'course_section_student','course_section_id','student_id');
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class,'assignment_student','assignment_id','student_id');
    }

    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function assigmentEvaluations()
    {
        return $this->hasMany(AssessmentEvaluations::class, 'assignment_id');
    }
}
