<?php

namespace App\Models\Settings;

use App;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Settings\semester
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $date
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newQuery()
 * @method static Builder|Semester onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereUpdatedAt($value)
 * @method static Builder|Semester withTrashed()
 * @method static Builder|Semester withoutTrashed()
 * @mixin Eloquent
 * @property string $start_date
 * @property string $end_date
 * @property-read string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereStartDate($value)
 * @property-read Collection|CourseSection[] $courseSection
 */
class Semester extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar', 'start_date', 'end_date'];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function courseSection()
    {
        return $this->hasMany(CourseSection::class);
    }
}
