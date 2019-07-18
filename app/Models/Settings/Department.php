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
 * App\Department
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @mixin Eloquent
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property int $college_id
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static Builder|Department onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCollegeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static Builder|Department withTrashed()
 * @method static Builder|Department withoutTrashed()
 * @property-read string $name
 * @property-read College $college
 * @property-read Collection|Program[] $programs
 */
class Department extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar', 'college_id'];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
