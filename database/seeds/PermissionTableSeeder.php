<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use CodeBase\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            [
                'name' => 'ver-admin',
                'display_name' => 'Ver Administração',
                'group_id' => 1,
                'sort' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-usuarios',
                'display_name' => 'Ver Usuários',
                'group_id' => 2,
                'sort' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'sync-usuarios',
                'display_name' => 'Importar Usuários',
                'group_id' => 2,
                'sort' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-usuarios',
                'display_name' => 'Editar Usuários',
                'group_id' => 2,
                'sort' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-perfis',
                'display_name' => 'Ver Perfis',
                'group_id' => 3,
                'sort' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add-perfis',
                'display_name' => 'Adicionar Perfis',
                'group_id' => 3,
                'sort' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'definir-perfis',
                'display_name' => 'Definir Perfis',
                'group_id' => 3,
                'sort' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-perfis',
                'display_name' => 'Editar Perfis',
                'group_id' => 3,
                'sort' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-permissoes',
                'display_name' => 'Ver Permissões',
                'group_id' => 4,
                'sort' => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add-permissoes',
                'display_name' => 'Adicionar Permissões',
                'group_id' => 4,
                'sort' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-permissoes',
                'display_name' => 'Editar Permissões',
                'group_id' => 4,
                'sort' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'deletar-permissoes',
                'display_name' => 'Deletar Permissões',
                'group_id' => 4,
                'sort' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add-grupos',
                'display_name' => 'Adicionar Grupos',
                'group_id' => 5,
                'sort' => 13,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-grupos',
                'display_name' => 'Editar Grupos',
                'group_id' => 5,
                'sort' => 14,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'deletar-grupos',
                'display_name' => 'Deletar Grupos',
                'group_id' => 5,
                'sort' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-parametros',
                'display_name' => 'Ver Parâmetros',
                'group_id' => 6,
                'sort' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-logs',
                'display_name' => 'Ver Logs',
                'group_id' => 7,
                'sort' => 17,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-cadastros',
                'display_name' => 'Ver Cadastros',
                'group_id' => 8,
                'sort' => 18,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-casas',
                'display_name' => 'Ver Casas',
                'group_id' => 9,
                'sort' => 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add-casas',
                'display_name' => 'Adicionar Casas',
                'group_id' => 9,
                'sort' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-casas',
                'display_name' => 'Editar Casas',
                'group_id' => 9,
                'sort' => 21,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'deletar-casas',
                'display_name' => 'Deletar Casas',
                'group_id' => 9,
                'sort' => 22,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-unidades',
                'display_name' => 'Ver Unidades',
                'group_id' => 10,
                'sort' => 23,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add-unidades',
                'display_name' => 'Adicionar Unidades',
                'group_id' => 10,
                'sort' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-unidades',
                'display_name' => 'Editar Unidades',
                'group_id' => 10,
                'sort' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'deletar-unidades',
                'display_name' => 'Deletar Unidades',
                'group_id' => 10,
                'sort' => 26,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-fornecedores',
                'display_name' => 'Ver Fornecedores',
                'group_id' => 11,
                'sort' => 27,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add-fornecedores',
                'display_name' => 'Adicionar Fornecedores',
                'group_id' => 11,
                'sort' => 28,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-contratos-fornecedor',
                'display_name' => 'Ver Contratos Fornecedor',
                'group_id' => 11,
                'sort' => 29,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-fornecedores',
                'display_name' => 'Editar Fornecedores',
                'group_id' => 11,
                'sort' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'deletar-fornecedores',
                'display_name' => 'Deletar Fornecedores',
                'group_id' => 11,
                'sort' => 31,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ver-movimentos',
                'display_name' => 'Ver Movimentações',
                'group_id' => 12,
                'sort' => 32,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'add-contratos',
                'display_name' => 'Cadastrar Contratos',
                'group_id' => 13,
                'sort' => 33,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'aditivar-contratos',
                'display_name' => 'Aditivar Contratos',
                'group_id' => 13,
                'sort' => 34,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'exportar-contratos',
                'display_name' => 'Exportar Contratos',
                'group_id' => 13,
                'sort' => 35,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'visualizar-contratos',
                'display_name' => 'Visualizar Contratos',
                'group_id' => 13,
                'sort' => 36,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'editar-contratos',
                'display_name' => 'Editar Contratos',
                'group_id' => 13,
                'sort' => 37,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'status-contratos',
                'display_name' => 'Definir Status Contratos',
                'group_id' => 13,
                'sort' => 38,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);

        $roleAdmin = Role::find(1);
        $roleAdmin->attachPermissions([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38]);

        $roleGerente = Role::find(2);
        $roleGerente->attachPermissions([1,2,3,12,13]);

    }
}
