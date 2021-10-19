<?php

namespace App\Providers;

use App\UserPermission;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return string
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies();

        /*try {
            if (Schema::hasTable('user_permissions')) {
                foreach ($this->getPermissions() as $permission) {
                    $gate->define($permission->name, function ($user) use ($permission) {
                        return $user->hasAccess($permission->name);
                    });
                }
            }
        } catch (QueryException $ex) {
            return $ex->getMessage();
        }*/
    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return UserPermission::with('roles')->get();
    }
}
