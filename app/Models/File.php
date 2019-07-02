<?php

namespace App\model;

use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

/**
 * App\model\File
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property string $path
 * @property int $size
 * @property string $fileable_type
 * @property int $fileable_id
 * @property int $user_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $fileable
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereDeletedAt($value)
 * @method static Builder|File whereDescription($value)
 * @method static Builder|File whereFileableId($value)
 * @method static Builder|File whereFileableType($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File wherePath($value)
 * @method static Builder|File whereSize($value)
 * @method static Builder|File whereType($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @method static Builder|File whereUserId($value)
 * @mixin Eloquent
 */
class File extends Model
{
    protected $fillable = ['name', 'description', 'type', 'path', 'size', 'fileable_id', 'fileable_type', 'user_id'];

    public function fileable()
    {
        return $this->morphTo();
    }

    /**
     * @param array $attributes
     */
    public function createFile($attributes = [])
    {
        /** @var UploadedFile $file */
        $file = $attributes['file'];
        $attributes['name'] = $file->getClientOriginalName();
        $attributes['size'] = $file->getSize();
        $attributes['type'] = $file->getClientMimeType();
        $attributes['user_id'] = Auth::id();

        $attributes['path'] = Storage::disk('public')->put($attributes['local_path'], $file);

        $this->create($attributes);
    }

    /**
     * @param array $attributes
     */
    public function updateFile($attributes = [])
    {
        /** @var UploadedFile $file */
        $file = $attributes['file'];
        $attributes['name'] = $file->getClientOriginalName();
        $attributes['size'] = $file->getSize();
        $attributes['type'] = $file->getClientMimeType();
        $attributes['user_id'] = Auth::id();

        $attributes['path'] = Storage::disk('public')->put($attributes['local_path'], $file);

        if ($attributes['old_file']) {
            Storage::disk('public')->delete($attributes['old_file']);
        }
        unset($attributes['local_path']);
        unset($attributes['file']);
        unset($attributes['old_file']);


        $this->update($attributes);
    }
}
