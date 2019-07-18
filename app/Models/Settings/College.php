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
 * App\College
 *
 * @method static \Illuminate\Database\Eloquent\Builder|College newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|College newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|College query()
 * @mixin Eloquent
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $name
 * @method static bool|null forceDelete()
 * @method static Builder|College onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|College whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|College whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|College whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|College whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|College whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|College whereUpdatedAt($value)
 * @method static Builder|College withTrashed()
 * @method static Builder|College withoutTrashed()
 * @property-read Collection|Department[] $departments
 */
class College extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar'];

    /**
     * @return string
     */
    public function getNameAttribute() {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function departments(){
        return $this->hasMany(Department::class);
    }
}
