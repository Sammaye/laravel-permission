<?php
namespace sammaye\Permission\Providers;

use Illuminate\Support\Facades\Schema;
use sammaye\Permission\Console\AssignPerrmission;
use sammaye\Permission\Console\AssignRole;
use sammaye\Permission\Console\AssignRolePermission;
use sammaye\Permission\Console\RefreshPermission;
use sammaye\Permission\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__ .'/../../config/config.php') => config_path('sammaye.permission.php')
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                AssignPerrmission::class,
                AssignRole::class,
                AssignRolePermission::class,
                RefreshPermission::class,
            ]);
        }

        $permissionClassName = config('sammaye.permission.permission');

        if (Schema::hasTable((new $permissionClassName)->getTable())) {
            Gate::before(function ($user, $ability) {
                return $user->hasPermission('root') ?: null;
            });

            foreach ($permissionClassName::all() as $perm) {
                Gate::define($perm->name, function ($user) use ($perm) {
                    return $user->hasPermission($perm->name);
                });
            }
        }
    }
}
