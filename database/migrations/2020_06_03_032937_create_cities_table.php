<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\City;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('state_id')->unsigned();
            $table->string('name', 100);
            $table->timestamps();
        });

        //Ciudad de Mexico id = 1
        $dataCities = [
            'Ciudad de Mexico'
        ];

        foreach ($dataCities as $dataCity) {
            $city = new City();
            $city->state_id = 1;
            $city->name = $dataCity;
            $city->save();
        }

        //Guanajuato id = 2
        $dataCities = [
            'Celaya', 'Guanajuato', 'Irapuato', 'León', 'Salamanca', 'Silao de la Victoria'
        ];

        foreach ($dataCities as $dataCity) {
            $city = new City();
            $city->state_id = 2;
            $city->name = $dataCity;
            $city->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
