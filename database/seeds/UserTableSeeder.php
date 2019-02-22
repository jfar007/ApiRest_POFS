<?php

use Illuminate\Database\Seeder;
use App\Rol;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolid = Rol::where('name', 'Administrador')->value('id');

        User::create([ 
            'username' => 'Adminplt',
            'password' =>  Hash::make('Foods@lutions07'),
            'name' => 'Administrador Plataforma',
            'email' => 'jfar07@hotmail.com',
            'branch_office' => 'all',
            'mobile_phone' => 'false',
            'landline' => 'false',
            'address' => 'false',
            'latitude_longitude_elevation' => 'false',
            'rol_id' => $rolid,
            'customer_id' =>  null,
            'branch_office_cf_id' => null,
            'confirmed' => '1',
            'confirmation_code' => null,
            'active' => '1'
            ]);

    }
}
