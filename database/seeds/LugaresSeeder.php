<?php

use Illuminate\Database\Seeder;

class LugaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('lugares')->insert([
    		'name' => 'Lugar1',
    		'description' => 'descriptionLugar1',
    		'ubicacion_id' => 1,
    	]);
    }
}
