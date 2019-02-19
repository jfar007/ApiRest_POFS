<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'FRZ',
            'short_name' => 'FRZ',
            'active'  => '1',
        ]);
        Category::create([
            'name' => 'REF',
            'short_name' => 'REF',
            'active'  => '1',
        ]);
        
        Category::create([
            'name' => 'DRY',
            'short_name' => 'DRY',
            'active'  => '1',
        ]);
    }
}
