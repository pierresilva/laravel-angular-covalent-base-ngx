<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereToken($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereUpdatedAt($value)
 */
class PasswordReset extends Model
{
    //
    protected $fillable = [
        'email', 'token'
    ];

    protected $dates = [
        'crated_at'
    ];

    public $incrementing = false;

    protected $primaryKey = 'email';

}
