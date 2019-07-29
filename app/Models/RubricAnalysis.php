<?php

namespace App\Models;

use App\Models\Settings\Assignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
