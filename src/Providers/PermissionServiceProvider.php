<?php
namespace sammaye\Permission\Providers;

use App\Console\Commands\AssignPerrmission;
use App\Console\Commands\AssignRole;
use App\Console\Commands\AssignRolePermission;
use App\Console\Commands\RefreshPermission;
use Illuminate\Support\Facades\Schema;
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

        if (Schema::hasTable((new Permission)->getTable())) {
            Gate::before(function ($user, $ability) {
                return $user->hasPermission('root') ?: null;
            });

            foreach (Permission::all() as $perm) {
                Gate::define($perm->name, function ($user) use ($perm) {
                    return $user->hasPermission($perm->name);
                });
            }
        }
    }
}
