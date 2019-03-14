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
            'item' => '10764',
            'name' => 'DESSERT APPLE CROSTATA',
            'pronunciation_in_english' => 'DESSERT APPLE CROSTATA',
            'description' => 'DESSERT APPLE CROSTATA',
            'packsize' => '1/24 CT',
            'picture_url' => 'https:',
            'category_id' => '1',
            'unit_id' => '1',
            'active' => '1',
        ]); 

        Product::create([
            'cod_fs' => '001',
            'item' => '10803',
            'name' => 'BASE MUSHROOM VEGAN',
            'pronunciation_in_english' => 'BASE MUSHROOM VEGAN',
            'description' => 'BASE MUSHROOM VEGAN',
            'packsize' => '4/5 LB',
            'picture_url' => 'https:',
            'category_id' => '2',
            'unit_id' => '4',
            'active' => '1',
        ]); 

        Product::create([
            'cod_fs' => '001',
            'item' => '11270',
            'name' => 'OIL NUTRA CLEAR NT',
            'pronunciation_in_english' => 'OIL NUTRA CLEAR NT',
            'description' => 'OIL NUTRA CLEAR NT',
            'packsize' => '1/35 LB',
            'picture_url' => 'https:',
            'category_id' => '3',
            'unit_id' => '4',
            'active' => '1',
        ]); 
    }
}
