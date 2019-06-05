<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'dsid';

    public function children()
    {
    	return $this->hasMany(Device::class,'parent_id','dsid');
    }
    public function parent()
    {
    	return $this->belongsTo(Device::class,'parent_id','dsid');
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
        $uri = 'https://auth.getshiftworx.com/app/api/v1/datasource/tree'; 
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
}
