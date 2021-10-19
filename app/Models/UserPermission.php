<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserPermission extends Model
{
    use SoftDeletes;

// generated section

    // Mass Assignment
    protected $fillable = ['name', 'code',];
    protected $dates = ['deleted_at'];


    // Validate Rule
    public static function getValidateRule(UserPermission $user_permission = null)
    {
        $table_name = 'user_permissions';
        $ignore_unique = '';
        if ($user_permission) {
            $ignore_unique = ',' . $user_permission->id;
        }
        $validation_rule = [
            'model.name' => 'required|unique:' . $table_name . ',name' . $ignore_unique,
            'model.code' => 'nullable',
        ];
        if ($user_permission) {

        }
        return $validation_rule;
    }


    public function userRoles()
    {
        return $this->belongsToMany('App\Models\UserRole')
            ->orderBy('id')
            ->withTimestamps();
    }

    public static function getRelationships()
    {
        return [
            'userRoles',
        ];
    }

    public static function getLists()
    {
        $lists = [];
        $lists['UserRole'] = UserRole::all();
        return $lists;
    }

    public function scopeUserRolesByName(Builder $query, $name)
    {
        return $query->whereHas('userRoles', function ($query) use ($name) {
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
