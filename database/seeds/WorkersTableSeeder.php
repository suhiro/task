<?php

use Illuminate\Database\Seeder;
use App\Worker;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Worker::create([
           'factory_id' => 1,
           'name' => '测试员工',
            'worker_id' => 8888,
            'national_id' => '1234567890abcdefghi',
            'wechat_openid' => 'oWs545OHGXXF3Cee0anv4g-nF8tw',
        ]) ;
    }
}
