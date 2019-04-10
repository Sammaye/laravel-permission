<?php
namespace sammaye\Permission\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;

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
}
