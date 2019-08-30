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
}
