<?php

namespace App\Models\Settings;

use App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Program
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program query()
 * @mixin Eloquent
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property int $department_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static Builder|Program onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedAt($value)
 * @method static Builder|Program withTrashed()
 * @method static Builder|Program withoutTrashed()
 * @property-read string $name
 * @property-read \App\Models\Settings\Department $department
 */
class Program extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar', 'department_id'];

    /**
     * @return string
     */
    public function getNameAttribute() {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function department(){
        return $this->belongsTo(department::class);
    }
}
