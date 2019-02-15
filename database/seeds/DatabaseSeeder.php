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

            'active' => '1',
        Rol::create([
            'name' => 'Admin',
            'active' => '1',
        ]);
        Rol::create([
            'name' => 'Distribuidor',
            'active' => '1',
        ]);
        Profile::create([
            'name' => 'Perfil 1',
            'active' => '1',
        ]);

        Profile::create([
            'name' => 'Perfil 2',
            'active' => '1',
        ]);

        Customer::create([
            'name' => 'KFC',
            'main_phone' => '7222254',
            'main_address' => 'CC Iserra 100',
            'profile_id' => '1',
            'active' => '1',
        ]);
    }
}
