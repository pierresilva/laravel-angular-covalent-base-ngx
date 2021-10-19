<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\File
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $file
 * @property string|null $extension
 * @property string|null $mime
 * @property string|null $url
 * @property int|null $fileable_id
 * @property string|null $fileable_type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Model|\Eloquent $fileable
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static \Illuminate\Database\Query\Builder|File onlyTrashed()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereDeletedAt($value)
 * @method static Builder|File whereExtension($value)
 * @method static Builder|File whereFile($value)
 * @method static Builder|File whereFileableId($value)
 * @method static Builder|File whereFileableType($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereMime($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @method static Builder|File whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|File withTrashed()
 * @method static \Illuminate\Database\Query\Builder|File withoutTrashed()
 * @mixin \Eloquent
 */
class File extends Model
{
    use SoftDeletes;

// generated section

	// Mass Assignment
	protected $fillable = ['name','file','extension','mime','url','fileable_id','fileable_type','type',];
    protected $dates = ['deleted_at'];

	// Validate Rule
    public static function getValidateRule(File $file=null){
        $ignore_unique = null;
        if($file){
            $ignore_unique = $file->id;
        }
        $table_name = 'files';
        $validation_rule = [

            'model.name' => 'required',
            'model.file' => 'required',
            'model.extension' => 'nullable',
            'model.mime' => 'nullable',
            'model.url' => 'nullable',
            'model.fileable_id' => 'nullable',
            'model.fileable_type' => 'nullable',


        ];
        if($file){

        }
        return $validation_rule;
    }




    public static function getRelationships()
    {
        return [
        ];
    }

	public static function getLists() {
		$lists = [];
		return $lists;
	}



// end section

    public function fileable()
    {
        return $this->morphTo('fileable', 'fileable_type', 'feleable_id');
    }

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
