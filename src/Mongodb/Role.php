<?php
namespace sammaye\Permission\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;
use sammaye\Permission\Traits\HasObjectId;

class Role extends Model
{
    use HasObjectId;

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
