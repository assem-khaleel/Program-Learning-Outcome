<?php

namespace App\Models\Settings;

use App\Models\AssignmentEvaluation;
use App\Models\Rubric;
use App\Models\RubricAnalysis;
use App\Models\RubricLevels;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;


/**
 * App\Models\Settings\Assignment
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $created_by
 * @property string $description_en
 * @property string $description_ar
 * @property int $course_sections_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $published
 * @property-read CourseSection $courseSection
 * @property-read string $description
 * @property-read string $name
 * @property-read Collection|Student[] $students
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment newQuery()
 * @method static Builder|Assignment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereCourseSectionsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereUpdatedAt($value)
 * @method static Builder|Assignment withTrashed()
 * @method static Builder|Assignment withoutTrashed()
 * @mixin Eloquent
 * @property int|null $rubric_id
 * @property-read Rubric|null $rubric
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereRubricId($value)
 * @property-read User $users
 * @property-read RubricAnalysis $analysis
 * @property-read Collection|AssignmentEvaluation[] $assessmentEvaluations
 */
class Assignment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar','description_en','description_ar','course_sections_id','created_by','published','rubric_id'];

    /**
     * @return string
     */
    public function getNameAttribute() {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute() {
        return App::getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function courseSection(){
        return $this->belongsTo(CourseSection::class, 'course_sections_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class,'assignment_student','student_id','assignment_id');
    }

    public function rubric(){
        return $this->belongsTo(Rubric::class,'rubric_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function analysis()
    {
        return $this->hasOne(RubricAnalysis::class);
    }

    public function assessmentEvaluations()
    {
        return $this->hasMany(AssignmentEvaluation::class, 'assignment_id');
    }
}
