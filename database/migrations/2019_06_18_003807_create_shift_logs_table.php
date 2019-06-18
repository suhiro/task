<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('dsid');
            $table->unsignedInteger('worker_id');
            $table->string('wechat_openid');
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('shift_logs');
    }
}
