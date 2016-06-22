<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContratoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contratos')->insert([
            [
                'casa_id' => 1,
                'numero' => '1422515',
                'ano' => '2016',
                'homologado' => 1251.25,
                'executado' => 1500.00,
                'empresa_id' => 1,
                'data_inicio' => Carbon::now(),
                'data_fim' => \Carbon\Carbon::createFromDate(2016,11,25),
                'created_at' => Carbon::now()
            ],
            [
                'casa_id' => 2,
                'numero' => '2004525',
                'ano' => '2016',
                'homologado' => 18521.10,
                'executado' => 18521.00,
                'empresa_id' => 3,
                'data_inicio' => Carbon::now(),
                'data_fim' => \Carbon\Carbon::createFromDate(2016,11,25),
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
