<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_types', function (Blueprint $table) {
          
            $table->increments('type_id')->unique();
            $table->integer('city_id');
            $table->integer('temperature');
            $table->integer('temperature_min');
            $table->integer('temperature_max');
            $table->decimal('wind_speed', 5, 2);
            $table->integer('wind_direction');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('cloudiness');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_types');
    }
}
