<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawLog extends Model
{
    protected $guarded = [];


    public static function api_activity($dsid, $start,$end, $minActivityLimit = null, $minInactivityLimit = null){
        $client = new \GuzzleHttp\Client();
        $uri = 'https://auth.getshiftworx.com/app/api/v1/datasource/activity'; 
        
        $uri .= "?dsid=$dsid";
        $uri .= "&start_time=$start";
        $uri .= "&end_time=$end";

        if($minActivityLimit)
        {
        	$uri .= "&min_activity_limit=$minActivityLimit";
        }
        if($minInactivityLimit)
        {
        	$uri .= "&min_inactivity_limit=$minInactivityLimit";
        }
        
        $res = $client->request('GET',$uri,[
            'headers' => [
                'api-token' => env('FREEPOINT_API_TOKEN'),
            ],
        ]);
        if($res->getStatusCode() == '200'){
            $json = json_decode($res->getBody()->getContents());
         
            if($json->message === 'Success'){
            	foreach($json->data->results as $r)
            	{
            		self::updateOrCreate([
            			'dsid'=>$dsid,
            			'time'=> $r->time,
            			'min_activity_limit' => $minActivityLimit,
            			'min_inactivity_limit' => $minInactivityLimit
            		],['state'=>$r->state]);
            	}
            }
            return $json->message;
        } else {
            return $res->getStatusCode();
        }   
    }
}
