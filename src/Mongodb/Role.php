<?php
namespace sammaye\Permission\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;

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
        return $this->belongsToMany(config('sammaye.permission.permission'));
    }
}
