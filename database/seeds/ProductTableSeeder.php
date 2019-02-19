<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        Product::create([
            'cod_fs' => '001',
            'item' => '1',
            'name' => 'DESSERT APPLE CROSTATA',
            'pronunciation_in_english' => 'DESSERT APPLE CROSTATA',
            'description' => 'DESSERT APPLE CROSTATA',
            'packsize' => '1/24 CT',
            'picture_url' => 'https:',
            'category_id' => '1',
            'unit_id' => '1',
            'active' => '1',
        ]); 
    }
}
