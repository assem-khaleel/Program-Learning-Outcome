<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\RubricIndicators
 *
 * @property int $id
 * @property string $indicator
 * @property int $order
 * @property int $score
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|RubricCells[] $rubricCells
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators newQuery()
 * @method static Builder|RubricIndicators onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereIndicator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereUpdatedAt($value)
 * @method static Builder|RubricIndicators withTrashed()
 * @method static Builder|RubricIndicators withoutTrashed()
 * @mixin Eloquent
 * @property int $rubric_id
 * @property-read Collection|Rubric[] $rubric
 * @method static \Illuminate\Database\Eloquent\Builder|RubricIndicators whereRubricId($value)
 */
class RubricIndicators extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['indicator', 'order', 'score', 'rubric_id'];

    /**
     * @return BelongsTo
     */
    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }

    /**
     * @return HasMany
     */
    public function rubricCells()
    {
        return $this->hasMany(RubricCells::class, 'indicator_id');
    }
}
