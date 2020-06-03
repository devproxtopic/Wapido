<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\CategoryFood;

class CreateCategoryFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_food', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });

        $dataCategoryFood = [
            'Pizza', 'Italiana', 'Carnes', 'Pescados y Mariscos', 'Americana', 'Mediterranea', 'Tacos',
            'Buffet', 'Comida Rápida', 'Cerveceria Artesanal', 'Varios'
        ];

        foreach ($dataCategoryFood as $categoryFood) {
            $cf = new CategoryFood();
            $cf->name = $categoryFood;
            $cf->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_food');
    }
}
