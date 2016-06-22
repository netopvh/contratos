<?php

namespace CodeBase\Http\Controllers\Access;

use CodeBase\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use CodeBase\Http\Requests;
use Adldap\Contracts\AdldapInterface;
use Adldap\Laravel\Traits\ImportsUsers;
use Adldap\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use CodeBase\Repositories\Role\RoleRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;

class UserImportController extends BaseController
{

    use ImportsUsers {
        syncModelFromAdldap as traitSyncModelFromAdldap;
    }

    /*
     * @var AdldapInterface
     */
    protected $adldap;

    /*
     * @var RoleRepositoryEloquent
     */
    protected $role;

    /*
     * Constructor
     *
     * @param AdldapInterface $adldap
     */
    public function __construct(
        AdldapInterface $adldap,
        RoleRepositoryEloquent $role
    )
    {
        parent::__construct();
        $this->adldap = $adldap;
        $this->role = $role;
    }

    /*
     * Retorna uma nova instância do usuário no eloquent
     *
     * @return CodeBase\Models\User
     */
    public function createModel()
    {
        return new \CodeBase\Models\User();
    }

    /**
     * {@inheritdoc}
     */
    public function syncModelFromAdlap(User $user, Authenticatable $model)
    {
        $this->traitSyncModelFromAdldap($user, $model);

        $role = $this->role->findWhere(['name' => 'usuario']);

        $model->attachRole($role);
    }

    /*
     * Importa todos os usuários do AD para o banco de dados
     */
    public function importAllUsers()
    {
        $role = $this->role->find(3);

        foreach ($this->getUsers() as $user) {

            $model = $this->getModelFromAdldap($user, str_random());

            if(! $this->isEmptyUser($model->username)){
                $model->save();
                $model->attachRole($role);
            }
        }

        return true;
    }

    public function isEmptyUser($user)
    {
        $result = $this->createModel()->where('username', $user)->first();

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function import()
    {
        $result = $this->importAllUsers();

        if(! $result){
            flash()->error('Erro ao Importar Usuários');
            return redirect()->route('users.index');
        }

        flash()->success('Usuários importados com Sucesso!');
        return redirect()->route('users.index');
    }

    public function getUsers()
    {
        $filter = '(memberof:1.2.840.113556.1.4.1941:=CN=Gestores,OU=SGVC,OU=ADINF,OU=Livre,DC=fiero,DC=org)';

        $users = $this->adldap->getDefaultProvider()->search()->users()->rawFilter($filter)->get();

        return $users;
    }

}
