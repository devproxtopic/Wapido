<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'Gramos',
            'symbol' => 'gr'
        ]);

        Unit::create([
            'name' => 'Kilogramos',
            'symbol' => 'Kg'
        ]);

        Unit::create([
            'name' => 'Litros',
            'symbol' => 'L'
        ]);

        Unit::create([
            'name' => 'Mililitros',
            'symbol' => 'ml'
        ]);

        Unit::create([
            'name' => 'Pulgadas',
            'symbol' => 'inch'
        ]);

        Unit::create([
            'name' => 'Onza',
            'symbol' => 'oz'
        ]);
    }
}
