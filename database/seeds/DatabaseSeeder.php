<?php

use Illuminate\Database\Seeder;
use App\Rol;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Rol::create([
            'name' => 'Not assigned',
            'active' => '1',
        ]);
        Rol::create([
            'name' => 'Admin',
            'active' => '1',
        ]);
        Rol::create([
            'name' => 'Distribuidor',
            'active' => '1',
        ]);
    }
}
