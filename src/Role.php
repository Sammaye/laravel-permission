<?php

namespace Sammaye\Permission;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(config('sammaye.permission.user'));
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
