<?php
namespace sammaye\Permission\Console;

use Illuminate\Console\Command;
use sammayePermission\Permission;
use sammayePermission\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AssignRolePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:role-permission {role_id} {permission_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a permission to a role';

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
        $role = Role::find($this->argument('role_id'));
        $permission = Permission::find($this->argument('permission_id'));

        if (!$role) {
            throw new NotFoundHttpException('Role not found');
        }

        if (!$permission) {
            throw new NotFoundHttpException('Permission not found');
        }

        $role->permissions()->attach($permission);
    }
}
