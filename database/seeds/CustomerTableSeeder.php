<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Customer::create([
            'name' => 'Olive Garden',
            'main_phone' => '7222254',
            'main_address' => 'CC 100',
            'profile_id' => '1',
            'active' => '1',
        ]);
        
        Customer::create([
            'name' => 'Copa Airlines',
            'main_phone' => '7222254',
            'main_address' => 'CC 100',
            'profile_id' => '2',
            'active' => '1',
        ]);

        Customer::create([
            'name' => 'Copa Club',
            'main_phone' => '7222254',
            'main_address' => 'CC 100',
            'profile_id' => '2',
            'active' => '1',
        ]);

   
    }
}
