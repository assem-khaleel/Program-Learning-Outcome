<?php

namespace App\Models\Settings;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Settings\CourseSection
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $semester_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection newQuery()
 * @method static Builder|CourseSection onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereUserId($value)
 * @method static Builder|CourseSection withTrashed()
 * @method static Builder|CourseSection withoutTrashed()
 * @mixin Eloquent
 */
class CourseSection extends Model
{
    use SoftDeletes;

    /**
     * The students that belong to the course section.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class,'course_section_student','course_section_id','student_id');
    }


}
