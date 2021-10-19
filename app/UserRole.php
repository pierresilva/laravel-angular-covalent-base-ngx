<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\UserRole
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserRole extends Model
{
    //

    use HasSlug;

    protected $fillable = ['name', 'code'];

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


    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(UserPermission::class, 'user_permission_user_role');
    }

    /**
     * Grant the given permission to a role.
     *
     * @param  UserPermission $permission
     *
     * @return mixed
     */
    public function givePermissionTo(UserPermission $permission)
    {
        return $this->permissions()->save($permission);
    }

    public function assignPermission($permission)
    {
        $permission = UserPermission::whereCode($permission)->first();
        if ($permission) {
            return $this->permissions()->save();
        }

        return null;

    }

}
