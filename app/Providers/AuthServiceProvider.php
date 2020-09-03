<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Role;

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
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//        app()->setLocale('vi');
        Gate::before(function ($user, $ability) {
//            dump($ability);
            if ($user->isSuperAdmin() || $user->isAdmin()) {
                return true;
            } else {
                $roles = [];
                if (!session()->has('roles')) {
                    $data = $user->group->roles()->select('name')->get()->toArray();
                    foreach ($data as $role) {
                        $roles[$role['name']] = 1;
                    }
                    session(['roles' => $roles]);
                } else {
                    $roles = session('roles');
                }
                return isset($roles[$ability]);
            }
        });

//        Gate::define('dashboard', function ($user) {
//            $type = get_group_type($user);
//            if($type == 'staff') return true;
//        });
    }
}
