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
 * App\Models\RubricLevels
 *
 * @property int $id
 * @property string $level
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|RubricCells[] $rubricCells
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels newQuery()
 * @method static Builder|RubricLevels onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels whereUpdatedAt($value)
 * @method static Builder|RubricLevels withTrashed()
 * @method static Builder|RubricLevels withoutTrashed()
 * @mixin Eloquent
 * @property int $rubric_id
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels whereRubricId($value)
 * @property int $order
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels whereOrder($value)
 * @property-read Rubric $rubric
 * @property int|null $percentage
 * @method static \Illuminate\Database\Eloquent\Builder|RubricLevels wherePercentage($value)
 */
class RubricLevels extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['level', 'rubric_id', 'order', 'percentage'];

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
        return $this->hasMany(RubricCells::class, 'level_id');
    }


}
