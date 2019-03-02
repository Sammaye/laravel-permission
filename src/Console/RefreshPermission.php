<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Sammaye\Permission\Permission;
use Sammaye\Permission\Role;

class RefreshPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the list of roles and permissions from the auth config';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions_map = config('sammaye.permission.permissions', []);
        foreach ($permissions_map as $k => $v) {
            if (is_numeric($k)) {
                // Simple permission
                Permission::updateOrCreate(['name' => $v]);
            } else {
                $role = Role::updateOrCreate(['name' => $k]);
                foreach ($v as $pv) {
                    $permission = Permission::updateOrCreate(['name' => $pv]);
                    $role->permissions()->attach($permission);
                }
            }
        }
    }
}
