<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('dsid');
            $table->datetime('start');
            $table->datetime('end')->nullable();
            $table->boolean('on');
            $table->unsignedSmallInteger('min_activity_limit')->nullable();
            $table->unsignedSmallInteger('min_inactivity_limit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::dropIfExists('device_logs');
    }
}
