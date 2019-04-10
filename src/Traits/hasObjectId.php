<?php
namespace sammaye\Permission\Traits;

use MongoDB\BSON\ObjectId;

trait HasObjectId
{
    public function getIdAttribute($value = null)
    {
        return new ObjectId(parent::getIdAttribute($value));
    }
}
