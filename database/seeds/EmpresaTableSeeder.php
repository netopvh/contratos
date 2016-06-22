<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('pt_BR');

        DB::table('empresas')->insert([
            [
                'razao' => $faker->company,
                'fantasia' => $faker->companySuffix,
                'cpf_cnpj' => '01254521412523',
                'tipo_pessoa' => 'PJ',
                'responsavel' => $faker->name,
                'email' => $faker->companyEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'razao' => $faker->company,
                'fantasia' => $faker->companySuffix,
                'cpf_cnpj' => '14257854635214',
                'tipo_pessoa' => 'PJ',
                'responsavel' => $faker->name,
                'email' => $faker->companyEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'razao' => $faker->company,
                'fantasia' => $faker->companySuffix,
                'cpf_cnpj' => '14258745236',
                'tipo_pessoa' => 'PF',
                'responsavel' => $faker->name,
                'email' => $faker->companyEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'razao' => $faker->company,
                'fantasia' => $faker->companySuffix,
                'cpf_cnpj' => '14257452369854',
                'tipo_pessoa' => 'PJ',
                'responsavel' => $faker->name,
                'email' => $faker->companyEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'razao' => $faker->company,
                'fantasia' => $faker->companySuffix,
                'cpf_cnpj' => '14752365214',
                'tipo_pessoa' => 'PF',
                'responsavel' => $faker->name,
                'email' => $faker->companyEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'razao' => $faker->company,
                'fantasia' => $faker->companySuffix,
                'cpf_cnpj' => '47585123696',
                'tipo_pessoa' => 'PF',
                'responsavel' => $faker->name,
                'email' => $faker->companyEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
