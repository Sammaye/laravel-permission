# laravel-permission
Really simple permissions (RBAC) plugin for Laravel.

## Usage

### Configure

You can find the configuration in `config/sammaye.permission.php` and it is called like `config('sammaye.permission.permissions)` to get a list of configured default permisisons.

#### Adding Permissions/Roles

Add content to the `permissions` key, arrays will be translated into roles and the elements into permissions.

#### Changing User

If you're not using the default `User` model then you change the `user` key.

### Add `User` Trait

Add `sammayePermission\Traits\HasPermission` to your user model.

### Finish

You're done.

## Commands

### Refersh permissions and roles

#### `permission:refresh` 

Will sync the permissions in your database with those in your configuration, so if you add new role and/or permissions in your configuration they will be reflected in your database.

#### `permission:permission {name} {user_id?}`

Will create a permission, if not existing, and assign it to a user, if supplied.

#### `permission:role {name} {user_id?}`

Will create a role, if not existing, and assign it to a user, if supplied.

#### `permission:role-permission {role_id} {permission_id}`

Will assign a role to a permission, will not create either if they do not exist.

## Overriding what's in the database

You can easily replace rules from the database with your own gate, like so:

```php
Gate::define('update-post', function(User $user, Post $post){
    return $user->hasPermission('edit-post') && $user->id === $post->user_id;
});
```

## Needs Improvement

- Caching of permissions to stop database calls which involve `JOIN`s
