<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Course
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Course onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Course whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Course whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\Course withoutTrashed()
 */
class Course extends Model
{
    use SoftDeletes;

    //
}
