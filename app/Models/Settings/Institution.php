<?php

namespace App\Models\Settings;

use App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Institution
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution query()
 * @mixin Eloquent
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $description_en
 * @property string $description_ar
 * @property string $vision_en
 * @property string $vision_ar
 * @property string $mission_en
 * @property string $mission_ar
 * @property string $location
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static Builder|Institution onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereMissionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereMissionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereVisionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereVisionEn($value)
 * @method static Builder|Institution withTrashed()
 * @method static Builder|Institution withoutTrashed()
 * @property-read string $description
 * @property-read string $mission
 * @property-read string $name
 * @property-read string $vision
 */
class Institution extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_en', 'name_ar', 'description_en', 'description_ar', 'vision_en', 'vision_ar', 'mission_en', 'mission_ar', 'location'];

    /**
     * @return string
     */
    public function getNameAttribute() {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute() {
        return App::getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    /**
     * @return string
     */
    public function getVisionAttribute() {
        return App::getLocale() == 'ar' ? $this->vision_ar : $this->vision_en;
    }

    /**
     * @return string
     */
    public function getMissionAttribute() {
        return App::getLocale() == 'ar' ? $this->mission_ar : $this->mission_en;
    }
}
