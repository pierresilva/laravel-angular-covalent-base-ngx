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
 *       "gender",
 *   },
 *   @OA\Xml(
 *     name="Author"
 *   ),
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     description="Author ID",
 *     readOnly="true",
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     description="Author  name; it tis unique",
 *   ),
 *   @OA\Property(
 *     property="code",
 *     type="string",
 *     description="Author code; it is unique",
 *     readOnly="true",
 *   ),
 *   @OA\Property(
 *     property="gender",
 *     type="string",
 *     description="Genero del autor",
 *   ),
 *   @OA\Property(
 *     property="birth_date",
 *     type="date",
 *     description="Author birthdate",
 *   ),
 *   @OA\Property(
 *     property="book_ids",
 *     type="array",
 *     example={0: 1, 1: 2},
 *     @OA\Items(
 *       type="number",
 *     ),
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
class Author extends Model
{
    use SoftDeletes;

// generated section

	// Mass Assignment
	protected $fillable = ['name','code','gender','birth_date',];
    protected $dates = ['deleted_at'];
	// Validate Rule
    public static function getValidateRule(Author $author=null){
        $ignore_unique = 'NULL';
        if($author){
            $ignore_unique = $author->id;
        }
        $table_name = 'authors';
        $validation_rule = [

            'model.name' => 'required|unique:'.$table_name.',name,'.$ignore_unique.',id,deleted_at,NULL',
            'model.code' => 'nullable|unique:'.$table_name.',code,'.$ignore_unique.',id,deleted_at,NULL',
            'model.gender' => 'required',
            'model.birth_date' => 'nullable',
        ];
        if($author){
        }
        return $validation_rule;
    }

	public function books() {
		return $this->belongsToMany('App\Models\Book')
		->orderBy('id')
		->withTimestamps();
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
