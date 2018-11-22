<?php

use App\Telefono;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Telefono::class, 23)->create();
    }
}
