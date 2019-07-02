<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Settings\CourseSection
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $semester_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\CourseSection onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\CourseSection whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\CourseSection withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\CourseSection withoutTrashed()
 * @mixin \Eloquent
 */
class CourseSection extends Model
{
    use SoftDeletes;

    //
}
