<?php

use Illuminate\Database\Seeder;
// use App\Rol;
// use App\Profile;
// use App\Customer;
// use App\BranchOffice;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(BranchOfficeTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(UserTableSeeder::class);
    
    }
}
