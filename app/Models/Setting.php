<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Setting extends Model
{
    // use SoftDeletes;

// generated section

	// Mass Assignment
	protected $fillable = ['name','code','value','rich_text','setting_group_id',];
    // protected $dates = ['deleted_at'];


	// Validate Rule
    public static function getValidateRule(Setting $setting=null){
        if($setting){
            $ignore_unique = $setting->id;
        }else{
            $ignore_unique = 'NULL';
        }
        $table_name = 'settings';
        $validation_rule = [

            'model.name' => 'required',
            'model.code' => 'required',
            'model.value' => 'nullable',
            'model.rich_text' => 'nullable',
            'model.setting_group_id' => 'integer|required',


        ];
        if($setting){

        }
        return $validation_rule;
    }



	public function settingGroup() {
		return $this->belongsTo('App\Models\SettingGroup');
	}



    public static function getRelationships()
    {
        return [
            'settingGroup',
        ];
    }

	public static function getLists() {
		$lists = [];
		$lists['SettingGroup'] = SettingGroup::all();
		return $lists;
	}

    public function scopeSettingGroupByName(Builder $query, $name)
    {
        return $query->whereHas('settingGroup', function ($query) use ($name) {
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
