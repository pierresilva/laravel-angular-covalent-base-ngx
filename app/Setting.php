<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Setting
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $setting_group_id
 * @property string $name
 * @property string|null $code
 * @property string $value
 * @property int|null $rich_text
 * @property-read \App\SettingGroup $group
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRichText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSettingGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    //
    use HasSlug;

    protected $fillable = ['setting_group_id', 'name', 'value', 'rich_text'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function (Model $model) {
                return $model->getGroup($model->setting_group_id)->name . '-' . $model->name;
            })
            ->saveSlugsTo('code')
            ->slugsShouldBeNoLongerThan(50)
            ->usingSeparator('.');
            // ->doNotGenerateSlugsOnUpdate();
    }

    public static function getRelationships()
    {
        return [
            'settingGroup'
        ];
    }

    public static function getLists()
    {
        $lists = [];
        $lists['SettingGroup'] = SettingGroup::all();
        return $lists;
    }

    public function settingGroup() {
        return $this->belongsTo(SettingGroup::class, 'setting_group_id', 'id');
    }

    public function getGroup($id) {
        return SettingGroup::find($id);
    }
}
