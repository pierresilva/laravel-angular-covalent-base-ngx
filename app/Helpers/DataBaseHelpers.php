<?php


namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataBaseHelpers
{

    public static function listTableForeignKeys($table)
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        return array_map(function ($key) {
            return $key->getName();
        }, $conn->listTableForeignKeys($table));
    }

    public static function dropForeignKey($table, $column)
    {
        $foreignKeys = self::listTableForeignKeys($table);
        if (in_array($table . '_' . $column . '_foreign', $foreignKeys)) {
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->dropForeign([$column]);
            });
        }
    }
}
