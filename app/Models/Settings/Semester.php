<?php

namespace App\Models\Settings;

use App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Settings\semester
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $date
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester newQuery()
 * @method static Builder|\App\Models\Settings\semester onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereUpdatedAt($value)
 * @method static Builder|\App\Models\Settings\semester withTrashed()
 * @method static Builder|\App\Models\Settings\semester withoutTrashed()
 * @mixin Eloquent
 */
class Semester extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar', 'start_date', 'end_date'];

    /**
     * @return string
     */
    public function getNameAttribute() {
        return App::getLocale() == 'ar' ? $this->name_en : $this->name_en;
    }
}
