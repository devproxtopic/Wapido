<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\CategoryOwner;

class CreateCategoryOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_owners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });

        $dataCategoryOwners = [
            'Comidas y Bebidas', 'Pastelerias', 'Farmacias', 'Tienda de Ropa', 'Ferreteria', 'Automotoras', 'Restaurantes',
            'Rentadora de Coches', 'Tienda Departamental', 'Productos Artesanales', 'Abarrotes', 'Varios'
        ];

        foreach ($dataCategoryOwners as $categoryOwner) {
            $co = new CategoryOwner();
            $co->name = $categoryOwner;
            $co->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_owners');
    }
}
