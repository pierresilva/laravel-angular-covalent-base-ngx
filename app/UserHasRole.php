<?php


namespace App;


trait UserHasRole
{

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'user_user_role', 'user_id', 'user_role_id');
    }

    /**
     * Assign the given role to the user.
     *
     * @param string $role
     *
     * @return mixed
     */
    public function assignRole($role)
    {

        return $this->roles()->save(
            UserRole::whereCode($role)->firstOrFail()
        );

    }

    /**
     * Determine if the user has the given role.
     *
     * @param mixed $role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        if (is_array($role)) {
            foreach ($role as $r) {
                if ($this->hasRole($r)) {
                    return true;
                }
            }

            return false;
        }

        return !!$role->intersect($this->roles)->count();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param UserPermission $permission
     *
     * @return boolean
     */
    public function hasPermission($permission)
    {

        return $this->hasRole($permission->roles);
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param $permission
     *
     * @return boolean
     */
    public function may($permission)
    {
        if (!$this) {
            return false;
        }
        if (is_string($permission)) {
            $permissionExists = \App\UserPermission::with('roles')->where('code', $permission)->first();
            if (!$permissionExists) {
                return false;
            }
            return $this->hasRole($permissionExists->roles);
        }

        if (is_array($permission)) {
            foreach ($permission as $perm) {
                $permissionExists = \App\UserPermission::with('roles')->where('code', $perm)->first();
                if (!$permissionExists) {
                    continue;
                }

                if ($this->hasRole($permissionExists->roles)) {
                    return true;
                }
            }

            return false;
        }

        if ($permission instanceof \App\UserPermission) {
            return $this->hasRole($permission->roles);
        }

    }

}
