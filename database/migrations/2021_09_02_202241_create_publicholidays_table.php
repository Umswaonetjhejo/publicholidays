<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicholidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicholidays', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->string('day', 2);
            $table->string('month', 11);
            $table->string('year', 4);
            $table->string('dayOfWeek', 3);
            $table->string('text', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicholidays');
    }
}
