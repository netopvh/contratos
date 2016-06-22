<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UnidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        DB::table('unidades')->insert([
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ],
            [
                'nome' => $faker->company,
                'casa_id' => $faker->numberBetween(1,4),
                'email' => $faker->companyEmail
            ]

        ]);
    }
}
