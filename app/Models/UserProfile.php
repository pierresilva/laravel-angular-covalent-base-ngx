<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\UserProfile
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int|null $user_id
 * @property int|null $syst_city_id
 * @property int|null $syst_region_id
 * @property int|null $syst_country_id
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static Builder|UserProfile newModelQuery()
 * @method static Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserProfile onlyTrashed()
 * @method static Builder|UserProfile query()
 * @method static Builder|UserProfile systCityByName($name)
 * @method static Builder|UserProfile systCountryByName($name)
 * @method static Builder|UserProfile systRegionByName($name)
 * @method static Builder|UserProfile userByName($name)
 * @method static Builder|UserProfile whereAddress($value)
 * @method static Builder|UserProfile whereAvatar($value)
 * @method static Builder|UserProfile whereCreatedAt($value)
 * @method static Builder|UserProfile whereDeletedAt($value)
 * @method static Builder|UserProfile whereId($value)
 * @method static Builder|UserProfile whereName($value)
 * @method static Builder|UserProfile wherePhone($value)
 * @method static Builder|UserProfile whereSystCityId($value)
 * @method static Builder|UserProfile whereSystCountryId($value)
 * @method static Builder|UserProfile whereSystRegionId($value)
 * @method static Builder|UserProfile whereUpdatedAt($value)
 * @method static Builder|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserProfile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserProfile withoutTrashed()
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use SoftDeletes;

// generated section

    // Mass Assignment
    protected $fillable = ['name', 'user_id', 'address', 'phone', 'avatar',];
    protected $dates = ['deleted_at'];

    // Validate Rule
    public static function getValidateRule(UserProfile $user_profile = null)
    {
        $ignore_unique = null;
        if ($user_profile) {
            $ignore_unique = $user_profile->id;
        }
        $table_name = 'user_profiles';
        $validation_rule = [

            'model.name' => 'required|unique:' . $table_name . ',name,' . $ignore_unique . ',id,deleted_at,NOT_NULL',
            'model.user_id' => 'integer|nullable',
            'model.address' => 'nullable',
            'model.phone' => 'nullable',
            'model.avatar' => 'nullable',


        ];
        if ($user_profile) {

        }
        return $validation_rule;
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public static function getRelationships()
    {
        return [
            'user',
        ];
    }

    public static function getLists()
    {
        $lists = [];
        $lists['User'] = User::all();
        return $lists;
    }

    public function scopeUserByName(Builder $query, $name)
    {
        return $query->whereHas('user', function ($query) use ($name) {
            $query->where('name', $name);
        });
    }


// end section

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            //
        });
        self::updating(function ($model) {
            //
        });
        self::deleting(function ($model) {
            //
        });
    }

}
