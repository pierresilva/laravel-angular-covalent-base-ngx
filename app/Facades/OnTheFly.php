<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void setConnection(int $id)
 * @method static string getConnectionName()
 *
 * @see \App\Services\OnTheFly
 */
class OnTheFly  extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \App\Services\OnTheFly::class;
    }
}
