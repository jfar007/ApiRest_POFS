<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'name' => 'Administrador',
            'active' => '1',
        ]);
        Rol::create([
            'name' => 'Distribuidor',
            'active' => '1',
        ]);

        Rol::create([
            'name' => 'Suscursal',
            'active' => '1',
        ]);
    }
}
