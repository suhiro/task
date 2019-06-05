<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorklogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worklogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('source_id');
            $table->datetime('date_from');
            $table->datetime('date_to');
            $table->string('object');
            $table->unsignedSmallInteger('index');
            $table->string('name');
            $table->boolean('new_st');
            $table->string('new_cs');
            $table->string('new_tm');
            $table->string('note');
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
        Schema::dropIfExists('worklogs');
    }
}
