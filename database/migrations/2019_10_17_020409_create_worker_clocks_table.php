<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_clocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('worker_id');
            $table->unsignedInteger('factory_id');
            $table->unsignedInteger('dsid')->nullable();
            $table->datetime('clock_in');
            $table->datetime('clock_out')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('worker_clocks');
    }
}
