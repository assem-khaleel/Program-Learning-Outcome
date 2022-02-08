<?php

namespace App\Models;

use App\Models\Settings\Assignment;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Settings\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;


/**
 * App\Models\Rubric
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $created_by
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|RubricIndicators[] $rubricIndicators
 * @property-read Collection|RubricLevels[] $rubricLevels
 * @property-read User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric newQuery()
 * @method static Builder|Rubric onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rubric whereUpdatedAt($value)
 * @method static Builder|Rubric withTrashed()
 * @method static Builder|Rubric withoutTrashed()
 * @mixin Eloquent
 * @property-read Collection|Assignment[] $assignments
 */
class Rubric extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function rubricIndicators()
    {
        return $this->hasMany(RubricIndicators::class);
    }

    public function rubricLevels()
    {
        return $this->hasMany(RubricLevels::class);
    }

    public function assignments(){
        return $this->hasMany(Assignment::class);
    }

//    public function LearningOutcomes(){
//        return $this->belongsTo(LearningOutcome::class,'');
//    }
}
