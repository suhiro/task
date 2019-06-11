<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $guarded = [];
    public function devices()
    {
    	return $this->hasMany(Device::class,'parent_id','dsid');
    }
}
