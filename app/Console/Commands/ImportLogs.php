<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Account;
use App\Device;
use App\RawLog;
use App\DeviceLog;


class ImportLogs extends Command
{

    protected $signature = 'import:logs';

    protected $description = 'Import data from FreePoint';

 
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $accounts = Account::get();

        $toTimestamp = now()->timestamp;
        $fromTimestamp = now()->subDay()->timestamp;
        $minActivityLimit = 60;
        $minInactivityLimit = 60;
        foreach($accounts as $account)
        {
            $this->info('importing data for account: '.$account->name);
            $devices = Device::where('parent_id',$account->dsid)->get();
            foreach($devices as $device)
            {
                $this->info("import data for device: $device->dsid $device->name");
                if(count($device->children)){
                    foreach($device->children as $terminal)
                    {
                        $this->info("import data for terminal device: $terminal->dsid $terminal->name");
                        RawLog::api_activity($terminal->dsid,$fromTimestamp,$toTimestamp,$minActivityLimit,$minInactivityLimit);
                        $this->processData($terminal->dsid,$fromTimestamp);
                    }
                }
                
            }
        }

    }

    private function processData($dsid,$fromTimestamp)
    {
        $logs = RawLog::where('dsid',$dsid)->where('time','>=',$fromTimestamp)->get();
        $this->info('total logs '.count($logs));
        $this->info('Processing logs');
        $currentLog = null;
        foreach($logs as $log)
        {
            if($log->state){
                if($currentLog){
                    $currentLog->end = \Carbon\Carbon::parse($log->time)->toDatetimeString();
                    $currentLog->save();
                }
                $currentLog = DeviceLog::create([
                                'dsid' => $log->dsid,
                                'start' => \Carbon\Carbon::parse($log->time)->toDatetimeString(),
                                'on' => true,
                                'min_activity_limit' => $log->min_activity_limit,
                                'min_inactivity_limit' => $log->min_inactivity_limit,
                                // 'end' => \Carbon\Carbon::parse($log->time)->toDatetimeString(),
                            ]);
            } else {
                if($currentLog){
                    $currentLog->end = \Carbon\Carbon::parse($log->time)->toDatetimeString();
                    $currentLog->save();
                }
                $currentLog = DeviceLog::create([
                    'dsid' => $log->dsid,
                    'start' => \Carbon\Carbon::parse($log->time)->toDatetimeString(),
                    'on' => false,
                    'min_activity_limit' => $log->min_activity_limit,
                    'min_inactivity_limit' => $log->min_inactivity_limit,
                ]);
                
            }
            
        }
    }
}