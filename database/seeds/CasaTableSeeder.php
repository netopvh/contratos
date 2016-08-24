<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('casas')->insert([
            [
                'nome' => 'SESI'
            ],
            [
                'nome' => 'SENAI'
            ],
            [
                'nome' => 'FIERO'
            ],
            [
                'nome' => 'IEL'
            ],
            [
                'nome' => 'SESI/SENAI'
            ]
        ]);
    }
}
