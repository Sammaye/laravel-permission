<?php
namespace sammaye\Permission;

use Illuminate\Database\Eloquent\Model;

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
        $this->belongsToMany(Role::class);
    }
}
