<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SettingGroup
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|SettingGroup[] $settings
 * @property-read int|null $settings_count
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SettingGroup extends Model
{
    //

    use HasSlug;

    protected $fillable = ['name'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('code')
            ->slugsShouldBeNoLongerThan(50)
            ->usingSeparator('.');
        // ->doNotGenerateSlugsOnUpdate();
    }

    public static function getRelationships()
    {
        return [
            'settings'
        ];
    }

    public static function getLists()
    {
        $lists = [];
        $lists['Setting'] = Setting::all();
        return $lists;
    }

    public function settings() {
        return $this->hasMany(Setting::class);
    }
}
