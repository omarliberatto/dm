<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('users')->insert([
    		'name' => 'Omar',
    		'email' => 'omar@kdk.com',
    		'password' => bcrypt('kdk'),
    	]);

//    	factory(User::class, 23)->create();

   }
}
