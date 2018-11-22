<?php

use Illuminate\Database\Seeder;

class TelefonoscacheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('telefonoscache')->insert([
    		'telefonostipo_id' => 1,
    		'lugar_id' => 1,
    		'persona_id' => 1,
    		'visible' => 1,
    	]);
    }
}
