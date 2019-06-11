<?php

use Illuminate\Database\Seeder;
use App\Account;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
        	'dsid' => 12520,
        	'api_token' => 'API-523c1-8a74f-044a9-39204',
        	'name' => 'XuFeng'
        ]);
    }
}
