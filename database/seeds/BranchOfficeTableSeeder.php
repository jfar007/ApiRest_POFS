<?php

use Illuminate\Database\Seeder;

use App\BranchOffice;

class BranchOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchOffice::create([
            'name' => 'KFC Iserra',
            'main_phone' => '31234521',
            'main_address' => 'Iserra',
            'latitude_longitude_elevation'  => '12345', 
            'customer_id'  => '1',
            'active'  => '1',
        ]);
    }
}
