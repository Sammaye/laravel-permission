<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Sammaye\Permission\Role;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:role {name} {user_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create and assign a role';

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
        $user_id = $this->argument('user_id');
        $user = null;
        if ($user_id) {
            $user = config('sammaye.permission.user')::find($user_id);

            if (!$user) {
                throw new NotFoundHttpException('User not found');
            }
        }

        $role = Role::updateOrCreate(['name' => $this->argument('name')]);

        if ($user) {
            $user->roles()->attach($role);
        }
    }
}
