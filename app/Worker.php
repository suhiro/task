<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $guarded = [];
    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }
}
