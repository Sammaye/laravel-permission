<?php

namespace Sammaye\Permission\Providers;

use App\Console\Commands\AssignPerrmission;
use App\Console\Commands\AssignRole;
use App\Console\Commands\AssignRolePermission;
use App\Console\Commands\RefreshPermission;
use Sammaye\Permission\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(DIR .'/../../config/config.php') => config_path('sammaye.permission.php')
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

        Gate::before(function ($id, $ability) {
            $user = config('sammaye.permission.user')::where('id', $id)->firstOrFail();
            return $user->hasPermission('root') ?: null;
        });

        foreach (Permission::all() as $perm) {
            Gate::define($perm->name, function ($id) use ($perm) {
                $user = config('sammaye.permission.user')::where('id', $id)->firstOrFail();
                return $user->hasPermission($perm->name);
            });
        }
    }
}
