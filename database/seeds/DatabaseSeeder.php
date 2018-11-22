<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'telefonos',
            'personas',
            'sectores',
            'ubicaciones'
        ]);

        // $this->call(UsersTableSeeder::class);
        // $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(UbicacionSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(LugaresSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(TelefonostiposSeeder::class);
        $this->call(TelefonoscacheSeeder::class);
        $this->call(TelefonoSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
