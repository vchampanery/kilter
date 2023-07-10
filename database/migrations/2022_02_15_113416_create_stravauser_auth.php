<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStravauserAuth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stravauser_auth', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stravaactivity_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('accessToken')->nullable();
            $table->string('refreshToken')->nullable();
            $table->string('expiresAt')->nullable();
            $table->boolean('isActive')->default(0);
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
        Schema::dropIfExists('stravauser_auth');
    }
}
