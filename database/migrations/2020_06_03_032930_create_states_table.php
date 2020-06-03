<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\State;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id')->unsigned();
            $table->string('name', 100);
            $table->timestamps();
        });

        $dataStates = [
            'Ciudad de Mexico', 'Guanajuato'
        ];

        foreach($dataStates as $dataState){
            $state = new State();
            $state->country_id = 1;
            $state->name = $dataState;
            $state->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
