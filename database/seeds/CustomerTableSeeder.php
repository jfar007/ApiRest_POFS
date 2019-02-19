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
            'name' => 'KFC',
            'main_phone' => '7222254',
            'main_address' => 'CC Iserra 100',
            'profile_id' => '1',
            'active' => '1',
        ]);

    }
}
