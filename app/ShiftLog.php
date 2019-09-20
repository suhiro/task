<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftLog extends Model
{
    protected $guarded = [];
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
    public function device()
    {
        return $this->belongsTo(Device::class,'dsid','dsid');
    }
}
