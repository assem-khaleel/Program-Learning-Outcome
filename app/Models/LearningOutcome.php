<?php

namespace App\Models;

use App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Settings\Program;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\LearningOutcome
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $description_en
 * @property string $description_ar
 * @property int $program_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $description
 * @property-read string $name
 * @property-read Program $program
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome newQuery()
 * @method static Builder|LearningOutcome onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LearningOutcome whereUpdatedAt($value)
 * @method static Builder|LearningOutcome withTrashed()
 * @method static Builder|LearningOutcome withoutTrashed()
 * @mixin Eloquent
 */
class LearningOutcome extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar', 'description_en', 'description_ar', 'program_id'];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
