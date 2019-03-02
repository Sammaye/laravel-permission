<?php
namespace sammaye\Permission\Traits;

use sammaye\Permission\Role;
use sammaye\Permission\Permission;

trait HasPermissions
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasRole($name)
    {
        return $this->roles()->where('name', $name)->count() > 0;
    }

    public function hasPermission($permission_name)
    {
        return in_array(
            $permission_name,
            $this->getPermissions(),
            true
        );
    }

    public function hasDirectPermission($permission_name)
    {
        return in_array(
            $permission_name,
            $this->getPermissions(false),
            true
        );
    }

    public function getPermissions($includeRoles = true)
    {
        $permissions = [];
        if ($includeRoles) {
            foreach ($this->roles()->with('permissions')->get() as $permission) {
                $permissions[$permission->name] = true;
            }
        }

        foreach ($this->permissions()->get() as $permission) {
            $permissions[$permission->name] = true;
        }

        return array_keys($permissions);
    }
}
