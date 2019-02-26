<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name' => 'Creado',
            'description' => 'Pedido creado.',
            'active' => '1',
        ]);
        Status::create([
            'name' => 'No confirmado',
            'description' => 'Pedido no confirmado por el cliente.',
            'active' => '1',
        ]);
        Status::create([
            'name' => 'Generado',
            'description' => 'Pedido autorizado por el cliente.',
            'active' => '1',
        ]);
        Status::create([
            'name' => 'Alistamiento',
            'description' => 'Pedido en curso esta en alistamiento.',
            'active' => '1',
        ]);
        Status::create([
            'name' => 'Transito',
            'description' => 'Pedido en curso esta en transito.',
            'active' => '1',
        ]);
        Status::create([
            'name' => 'Entregado',
            'description' => 'Pedido en curso esta en entregado.',
            'active' => '1',
        ]);        
    }
}
