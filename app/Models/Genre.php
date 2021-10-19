<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 *
 * @OA\Schema(
 *   required={
 *       "name",
 *   },
 *   @OA\Xml(
 *     name="Genre"
 *   ),
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     description="Genre ID",
 *     readOnly="true",
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     description="Genre name; it is unique",
 *   ),
 *   @OA\Property(
 *     property="code",
 *     type="string",
 *     description="Genre code; it is unique",
 *     readOnly="true",
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="date-time",
 *     description="Initial creation timestamp",
 *     readOnly="true"
 *   ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     format="date-time",
 *     description="Last update timestamp",
 *     readOnly="true"
 *   ),
 *   @OA\Property(
 *     property="deleted_at",
 *     type="string",
 *     format="date-time",
 *     description="Soft delete timestamp",
 *     readOnly="true"
 *   )
 * )
 *
 * Class Book
 *
 */
class Genre extends Model
{
    use SoftDeletes;
// generated section

	// Mass Assignment
	protected $fillable = ['name','code',];
    protected $dates = ['deleted_at'];
	// Validate Rule
    public static function getValidateRule(Genre $genre=null){
        $ignore_unique = 'NULL';
        if($genre){
            $ignore_unique = $genre->id;
        }
        $table_name = 'genres';
        $validation_rule = [

            'model.name' => 'required|unique:'.$table_name.',name,'.$ignore_unique.',id,deleted_at,NULL',
            'model.code' => 'nullable|unique:'.$table_name.',code,'.$ignore_unique.',id,deleted_at,NULL',
        ];
        if($genre){
        }
        return $validation_rule;
    }

	public function books() {
		return $this->hasMany('App\Models\Book');
	}
    public static function getRelationships()
    {
        return [
            'books',
        ];
    }

	public static function getLists() {
		$lists = [];
		$lists['Book'] = Book::all();
		return $lists;
	}

    public function scopeBooksByTitle(Builder $query, $title)
    {
        return $query->whereHas('books', function ($query) use ($title) {
            $query->where('title', $title);
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
