<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use App\Worklog;
use Carbon\Carbon;

class UploadController extends Controller
{
    public function index()
    {
    	return view('upload');
    }
    public function upload(Request $request)
    {
    	$path = Storage::putFile('csvs', $request->file('csv_file'));
    	
    	$csv = Reader::createFromPath('/Users/hiro/code/task/storage/app/'.$path,'r');
    	$csv->setHeaderOffset(0);
    	
    	$header = $csv->getHeader();
    	$records = $csv->getRecords();
    	foreach ($records as $offset => $record) {
		  
		    Worklog::create([
		    	'source_id' => $record['id'],
		    	'date_from' => $record['Date'],
		    	'date_to' => Carbon::parse($record['Date'])->addMinute()->toDateTimeString(),
		    	'object' => $record['Object'],
		    	'index' => $record['Indx'],
		    	'name' => $record['Name'],
		    	'new_st' => $record['NewSt'],
		    	'new_cs' => $record['NewCt'],
		    	'new_tm' => $record['NewTm'],
		    	'note' => $record['Note'],
		    ]);

		}
		Storage::delete($path);
		return redirect('/');

    }
}
