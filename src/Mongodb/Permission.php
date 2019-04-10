<?php
namespace sammaye\Permission\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;
use sammaye\Permission\Traits\HasObjectId;

class Permission extends Model
{
    use HasObjectId;

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
