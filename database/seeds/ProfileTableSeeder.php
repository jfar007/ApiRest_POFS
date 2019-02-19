<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        Profile::create([
            'name' => 'Perfil 1',
            'active' => '1',
        ]);

        Profile::create([
            'name' => 'Perfil 2',
            'active' => '1',
        ]);

    }
}
