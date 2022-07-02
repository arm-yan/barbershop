<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('monday')->default('08:00-22:00')->nullable();
            $table->string('tuesday')->default('08:00-22:00')->nullable();
            $table->string('wednesday')->default('08:00-22:00')->nullable();
            $table->string('thursday')->default('08:00-22:00')->nullable();
            $table->string('friday')->default('08:00-22:00')->nullable();
            $table->string('saturday')->default('08:00-22:00')->nullable();
            $table->string('sunday')->default('08:00-22:00')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
