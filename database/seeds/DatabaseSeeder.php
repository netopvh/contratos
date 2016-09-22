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
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionGroupTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CasaTableSeeder::class);
        //$this->call(EmpresaTableSeeder::class);
        //$this->call(ContratoTableSeeder::class);
        $this->call(UnidadeTableSeeder::class);
    }
}
