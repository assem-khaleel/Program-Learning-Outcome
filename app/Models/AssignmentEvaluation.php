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
 * App\model\AssignmentEvaluation
 *
 * @property-read Assignment $assessment
 * @property-read RubricCells $rubricCell
 * @property-read Student $student
 * @method static Builder|AssignmentEvaluation newModelQuery()
 * @method static Builder|AssignmentEvaluation newQuery()
 * @method static Builder|AssignmentEvaluation query()
 * @mixin Eloquent
 * @property int $id
 * @property int $assignments_id
 * @property int $student_id
 * @property int $rubric_cell_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|AssignmentEvaluation whereAssignmentsId($value)
 * @method static Builder|AssignmentEvaluation whereCreatedAt($value)
 * @method static Builder|AssignmentEvaluation whereId($value)
 * @method static Builder|AssignmentEvaluation whereRubricCellId($value)
 * @method static Builder|AssignmentEvaluation whereStudentId($value)
 * @method static Builder|AssignmentEvaluation whereUpdatedAt($value)
 */
class AssignmentEvaluation extends Model
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
