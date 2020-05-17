<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Activo'
        ]);

        Status::create([
            'name' => 'Pendiente'
        ]);

        Status::create([
            'name' => 'Pagado'
        ]);

        Status::create([
            'name' => 'Por Pagar'
        ]);

        Status::create([
            'name' => 'Entregado'
        ]);

        Status::create([
            'name' => 'Perdido'
        ]);
    }
}
