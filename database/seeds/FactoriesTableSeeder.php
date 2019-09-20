<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('factories')->insert([
            'account_id' => 1,
        	'dsid' => 12520,
        	'name' => '第一工厂',
        	'description' => '高科技第一实验工厂',
        ]);
    }
}
