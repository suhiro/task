<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'dsid';
    protected $appends = ['full_name'];

    public function children()
    {
    	return $this->hasMany(Device::class,'parent_id','dsid');
    }
    public function parent()
    {
    	return $this->belongsTo(Device::class,'parent_id','dsid');
    }
    public function logs()
    {
        return $this->hasMany(DeviceLog::class,'dsid');
    }

    public function getFullNameAttribute()
    {
//        return 'full name';
        return $this->parent? $this->parent->name .' '.$this->name.' ('.$this->dsid.')': $this->name;
    }

    public function getCustomAttribute()
    {
        return 'custom';
    }


    public static function syncDevices($parentId = null)
    {
    	if($parentId){

    		$res = self::tree($parentId);

    		if($res->message === 'Success' && isset($res->data->children)) {

    			foreach($res->data->children as $device)
    			{
    				self::updateOrCreate(['parent_id'=>$parentId,'dsid' => $device->id],['name'=>$device->name]);
    				self::syncDevices($device->id);
    			}

    		} elseif($res->message === 'Success' && !isset($res->data->children)){
                self::updateOrCreate(['dsid' => $res->data->id],['name' => $res->data->name,'terminal' => true]);
            }

    	} else {
    		$res = self::tree();
    		if($res->message === 'Success'){
    			$rootId = $res->data->id;
    			self::syncDevices($rootId);
    		}
    	}
    }


    public static function tree($dsid = null){
        $client = new \GuzzleHttp\Client();
        $uri = 'https://api.getshiftworx.com/v1/datasource/tree'; 
        if($dsid){
        	$uri .= "?dsid=$dsid";
        }
        
        $res = $client->request('GET',$uri,[
            'headers' => [
                'api-token' => env('FREEPOINT_API_TOKEN'),
            ],
        ]);
        if($res->getStatusCode() == '200'){
            $json = json_decode($res->getBody()->getContents());
         
            return $json;
        } else {
            return $res->getStatusCode();
        }   
    }

    public function scopeTerminal($query)
    {
        return $query->where('terminal',true);
    }
}
