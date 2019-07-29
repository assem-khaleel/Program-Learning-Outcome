<?php

namespace App\Models;

use App\Models\Settings\Assignment;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\RubricAnalysis
 *
 * @property int $id
 * @property string $analysis
 * @property string $recommendations
 * @property string $actions
 * @property int $assignment_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Assignment $assignment
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis newQuery()
 * @method static Builder|RubricAnalysis onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereActions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereRecommendations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RubricAnalysis whereUpdatedAt($value)
 * @method static Builder|RubricAnalysis withTrashed()
 * @method static Builder|RubricAnalysis withoutTrashed()
 * @mixin Eloquent
 */
class RubricAnalysis extends Model
{
    use SoftDeletes;

    protected $table = 'rubric_analysis';
    protected $fillable = ['assignment_id', 'analysis', 'recommendations','actions'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
