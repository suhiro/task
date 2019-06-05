<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('dsid');
            $table->unsignedInteger('time');
            $table->boolean('state');
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
        Schema::dropIfExists('raw_logs');
    }
}
