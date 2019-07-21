<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\RubricCells
 *
 * @property int $id
 * @property string $description
 * @property int $indicator_id
 * @property int $rubric_id
 * @property int $level_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Rubric $rubric
 * @property-read RubricIndicators $rubricIndicator
 * @property-read RubricLevels $rubricLevel
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells newQuery()
 * @method static Builder|RubricCells onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereIndicatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereRubricId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereUpdatedAt($value)
 * @method static Builder|RubricCells withTrashed()
 * @method static Builder|RubricCells withoutTrashed()
 * @mixin Eloquent
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|RubricCells whereDeletedAt($value)
 */
class RubricCells extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'indicator_id', 'level_id'];

    /**
     * @return BelongsTo
     */
    public function rubricIndicator()
    {
        return $this->belongsTo(RubricIndicators::class, 'indicator_id');
    }

    /**
     * @return BelongsTo
     */
    public function rubricLevel()
    {
        return $this->belongsTo(RubricLevels::class, 'level_id');
    }


}
