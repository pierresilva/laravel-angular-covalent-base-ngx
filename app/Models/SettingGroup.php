<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SettingGroup extends Model
{
    // use SoftDeletes;

// generated section

	// Mass Assignment
	protected $fillable = ['name','code',];
    // protected $dates = ['deleted_at'];


	// Validate Rule
    public static function getValidateRule(SettingGroup $setting_group=null){
        if($setting_group){
            $ignore_unique = $setting_group->id;
        }else{
            $ignore_unique = 'NULL';
        }
        $table_name = 'setting_groups';
        $validation_rule = [

            'model.name' => 'required',
            'model.code' => 'nullable',


        ];
        if($setting_group){

        }
        return $validation_rule;
    }

	public function settings() {
		return $this->hasMany('App\Models\Setting');
	}

    public static function getRelationships()
    {
        return [
            'settings',
        ];
    }

	public static function getLists() {
		$lists = [];
		$lists['Setting'] = Setting::all();
		return $lists;
	}

    public function scopeSettingsByName(Builder $query, $name)
    {
        return $query->whereHas('settings', function ($query) use ($name) {
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
