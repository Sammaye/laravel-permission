<?php
namespace sammaye\Permission\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class Permission extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(config('sammaye.permission.user'));
    }

    public function roles()
    {
        $this->belongsToMany(config('sammaye.permission.role'));
    }

    public static function setGates()
    {
        Gate::before(function ($user, $ability) {
            return $user->hasPermission('root') ?: null;
        });

        foreach (static::all() as $perm) {
            Gate::define($perm->name, function ($user) use ($perm) {
                return $user->hasPermission($perm->name);
            });
        }
    }
}
