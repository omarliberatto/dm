<?php

use Illuminate\Database\Seeder;

class TelefonostiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('telefonostipos')->insert([
    		'name' => 'Telefonostipos1',
    	]);
    }
}
