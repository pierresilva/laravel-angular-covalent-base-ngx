<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @OA\Schema(
 *   required={
 *       "title",
 *       "edition",
 *   },
 *   @OA\Xml(
 *     name="Book"
 *   ),
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     description="Book ID",
 *     readOnly="true",
 *   ),
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Book title",
 *   ),
 *   @OA\Property(
 *     property="code",
 *     type="string",
 *     description="Book code; is generated by the system",
 *     readOnly="true",
 *   ),
 *   @OA\Property(
 *     property="genre_id",
 *     type="integer",
 *     description="Book genre",
 *   ),
 *   @OA\Property(
 *     property="cover",
 *     type="string",
 *     description="Book cover url; it is display as file input",
 *   ),
 *   @OA\Property(
 *     property="published_at",
 *     type="date",
 *     description="Book published date",
 *   ),
 *   @OA\Property(
 *     property="edition",
 *     type="integer",
 *     description="Book edition number",
 *   ),
 *   @OA\Property(
 *     property="bought_at",
 *     type="timestamp",
 *     description="Book bought date and time",
 *   ),
 *   @OA\Property(
 *     property="resume",
 *     type="longtext",
 *     description="Book resume; it is display as rich text input",
 *   ),
 *   @OA\Property(
 *     property="tag_ids",
 *     type="array",
 *     example={0: 1, 1: 2},
 *     @OA\Items(
 *       type="number",
 *     ),
 *   ),
 *   @OA\Property(
 *     property="author_ids",
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
class Book extends Model
{
  use SoftDeletes;

// generated section

  // Mass Assignment
  protected $fillable = ['title', 'code', 'genre_id', 'cover', 'published_at', 'edition', 'bought_at', 'resume',];
  protected $dates = ['deleted_at'];

  // Validate Rule
  public static function getValidateRule(Book $book = null)
  {
    $ignore_unique = 'NULL';
    if ($book) {
      $ignore_unique = $book->id;
    }
    $table_name = 'books';
    $validation_rule = [

      'model.title' => 'required|unique:' . $table_name . ',title,' . $ignore_unique . ',id,deleted_at,NULL',
      'model.code' => 'nullable|unique:' . $table_name . ',code,' . $ignore_unique . ',id,deleted_at,NULL',
      'model.genre_id' => 'integer|nullable',
      'model.cover' => 'nullable',
      'model.published_at' => 'nullable',
      'model.edition' => 'integer|required',
      'model.bought_at' => 'nullable',
      'model.resume' => 'nullable',
    ];
    if ($book) {
    }
    return $validation_rule;
  }

  public function getBoughtAtAttribute($value) {
    return date('Y-m-d\TH:i:s', strtotime($value));
  }

  public function genre()
  {
    return $this->belongsTo('App\Models\Genre');
  }

  public function tags()
  {
    return $this->belongsToMany('App\Models\Tag')
      ->orderBy('id')
      ->withTimestamps();
  }

  public function authors()
  {
    return $this->belongsToMany('App\Models\Author')
      ->orderBy('id')
      ->withTimestamps();
  }

  public static function getRelationships()
  {
    return [
      'genre',
      'tags',
      'authors',
    ];
  }

  public static function getLists()
  {
    $lists = [];
    $lists['Genre'] = Genre::all();
    $lists['Tag'] = Tag::all();
    $lists['Author'] = Author::all();
    return $lists;
  }

  public function scopeGenreByName(Builder $query, $name)
  {
    return $query->whereHas('genre', function ($query) use ($name) {
      $query->where('name', $name);
    });
  }

  public function scopeTagsByName(Builder $query, $name)
  {
    return $query->whereHas('tags', function ($query) use ($name) {
      $query->where('name', $name);
    });
  }

  public function scopeAuthorsByName(Builder $query, $name)
  {
    return $query->whereHas('authors', function ($query) use ($name) {
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
