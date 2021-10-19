<?php

namespace App\Helpers;

use App\UserPermission;

class AuthHelper
{

    public static function userCan(...$permissions): bool
    {
        if (!auth()->user()) {
            return false;
        }
        foreach ($permissions as $permission) {
            $permissionExists = UserPermission::with('roles')->where('code', $permission)->first();
            if (!$permissionExists) {
                continue;
            } else {
                return auth()->user()->hasPermission($permissionExists);
            }
        }

        return false;
    }

}
