<?php

namespace App\Models;

use App\Models\RubricCells;
use App\Models\Settings\Assignment;
use App\Models\Settings\Student;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\AssessmentEvaluations
 *
 * @property int $id
 * @property int $assessment_id
 * @property int $student_id
 * @property int $rubric_cell_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Assignment $assessment
 * @property-read \App\Models\RubricCells $rubricCell
 * @property-read Student $student
 * @method static Builder|AssessmentEvaluations newModelQuery()
 * @method static Builder|AssessmentEvaluations newQuery()
 * @method static Builder|AssessmentEvaluations query()
 * @method static Builder|AssessmentEvaluations whereAssignmentsId($value)
 * @method static Builder|AssessmentEvaluations whereCreatedAt($value)
 * @method static Builder|AssessmentEvaluations whereId($value)
 * @method static Builder|AssessmentEvaluations whereRubricCellId($value)
 * @method static Builder|AssessmentEvaluations whereStudentId($value)
 * @method static Builder|AssessmentEvaluations whereUpdatedAt($value)
 * @mixin Eloquent
 */
class AssessmentEvaluations extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['assignments_id', 'student_id', 'rubric_cell_id'];

    public function rubricCell()
    {
        return $this->belongsTo(RubricCells::class, 'rubric_cell_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
