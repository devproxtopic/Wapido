<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_owner_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('email', 150);
            $table->string('logo', 255);
            $table->string('phone', 150);
            $table->string('sliders', 255);
            $table->string('description', 255);
            $table->string('slug', 255)->unique();
            $table->time('opening_hours')->nullable();
            $table->time('closing_hours')->nullable();
            $table->string('days_not_reservation', 255)->nullable();
            $table->boolean('order_enabled')->nullable();
            $table->boolean('main_digital_enabled')->nullable();
            $table->boolean('reservations_enabled')->nullable();
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
        Schema::dropIfExists('owners');
    }
}
