<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $guarded = [];
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
    public function devices()
    {
        return $this->hasMany(Device::class,'parent_id','dsid');
    }


}
