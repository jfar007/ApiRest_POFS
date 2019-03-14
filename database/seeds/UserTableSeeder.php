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

        $rolid = Rol::where('name', 'Distribuidor')->value('id');

        User::create([ 
            'username' => 'fsdis001',
            'password' =>  Hash::make('Foodsolutions'),
            'name' => 'Distribuidor de la Plataforma',
            'email' => 'no-reply@foodsolutionsmarket.com',
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

            
        $rolid = Rol::where('name', 'Suscursal')->value('id');
        User::create([ 
            'username' => 'fsduser1',
            'password' =>  Hash::make('Foodsolutions'),
            'name' => 'Sucursal de la Plataforma',
            'email' => 'no-reply2@foodsolutionsmarket.com',
            'branch_office' => 'all',
            'mobile_phone' => 'false',
            'landline' => 'false',
            'address' => 'false',
            'latitude_longitude_elevation' => 'false',
            'rol_id' => $rolid,
            'customer_id' =>  1,
            'branch_office_cf_id' => 1,
            'confirmed' => '1',
            'confirmation_code' => null,
            'active' => '1'
            ]);
    
        User::create([ 
            'username' => 'fsduser2',
            'password' =>  Hash::make('Foodsolutions'),
            'name' => 'Sucursal de la Plataforma',
            'email' => 'no-reply3@foodsolutionsmarket.com',
            'branch_office' => 'all',
            'mobile_phone' => 'false',
            'landline' => 'false',
            'address' => 'false',
            'latitude_longitude_elevation' => 'false',
            'rol_id' => $rolid,
            'customer_id' =>  2,
            'branch_office_cf_id' => 2,
            'confirmed' => '1',
            'confirmation_code' => null,
            'active' => '1'
            ]);


    }
}
