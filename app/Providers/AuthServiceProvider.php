<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Permission;
use App\Models\User;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $moduleLists = Permission::where('parent_id', 0)->get();
        if ($moduleLists->count()>0)
        {
            foreach ($moduleLists as $module)
            {
                Gate::define($module->name, function (User $user) use ($module) {
                    $permissions = Permission::where('parent_id', $module->id)->get();
                    foreach ($permissions as $permission)
                    {
                        return $user->checkPermissionAccess($permission->name);
                    }
                    return false;
                });

                Gate::define($module->name.'.edit', function (User $user) use ($module) {
                    $permissions = Permission::where('parent_id', $module->id)->get();
                    foreach ($permissions as $permission)
                    {
                        if ($permission->name == 'edit')
                        {
                            return $user->checkPermissionAccess($permission->name);
                        }
                    }
                    return false;
                });
            }
        }
        //gate access dashboard
        Gate::define('access-dashboard', function (User $user){
            return true;
        });
    }
}
