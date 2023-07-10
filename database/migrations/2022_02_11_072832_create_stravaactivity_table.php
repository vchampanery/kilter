<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStravaactivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('stravaactivity')) {
            Schema::dropIfExists('stravaactivity');
        }
        Schema::create('stravaactivity', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stravaactivity_id')->nullable();
            $table->integer('athlete_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('distance')->nullable();
            $table->string('type')->nullable();
            $table->integer('workout_type')->nullable();
            $table->dateTime('start_date_local')->nullable();
            $table->decimal('average_speed',10,2)->nullable();
            $table->decimal('max_speed',10,2)->nullable();
            $table->text('raw_data')->nullable();
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
        Schema::dropIfExists('stravaactivity');
    }
}
