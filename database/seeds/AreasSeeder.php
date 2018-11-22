<?php

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('areas')->insert([
    		'name' => 'Areas1',
    		'description' => 'descriptionArea1',
    	]);
    }
}
