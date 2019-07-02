<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Settings\semester
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\semester onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings\semester whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\semester withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings\semester withoutTrashed()
 * @mixin \Eloquent
 */
class semester extends Model
{
    use SoftDeletes;

    //
}
