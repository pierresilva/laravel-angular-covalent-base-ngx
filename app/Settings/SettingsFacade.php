<?php


namespace App\Settings;


class SettingsFacade
{

    public function get($code = '')
    {
        return [
            'name' => 'Nombre del parametro',
            'code' => 'codigo.del.parametro'
        ];
    }

    public function getGroup($groupCode = '')
    {
        return [
            [
                'name' => 'Nombre del parametro 1',
                'code' => 'codigo.del.parametro.1'
            ],
            [
                'name' => 'Nombre del parametro 2',
                'code' => 'codigo.del.parametro.2'
            ]
        ];
    }
}
