<?php

use Illuminate\Database\Seeder;
use App\Unit;


class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'Cajas',
            'short_name' => 'Cajas',
            'active'  => '1',
        ]);
        
        Unit::create([
            'name' => 'Unidades',
            'short_name' => 'Unidades',
            'active'  => '1',
        ]);

        Unit::create([
            'name' => 'Kg',
            'short_name' => 'Kg',
            'active'  => '1',
        ]);

        Unit::create([
            'name' => 'Libras',
            'short_name' => 'Libras',
            'active'  => '1',
        ]);
    }
}
