<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStravauserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('stravauser')) {
            Schema::dropIfExists('stravauser');
        }
        Schema::create('stravauser', function (Blueprint $table) {
            $table->id();
            $table->integer('strava_id');
            $table->integer('user_id');
            $table->string('username');
            $table->text('raw_data');
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
        Schema::dropIfExists('stravauser');
    }
}
