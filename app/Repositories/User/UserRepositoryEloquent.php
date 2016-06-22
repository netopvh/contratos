<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 27/04/2016
 * Time: 08:45
 */

namespace CodeBase\Repositories\User;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeBase\Repositories\User\UserRepository;
use CodeBase\Models\User;

/*
 * Class UserRepositoryEloquent
 * @package namespace CodeBase\Repositories
 */

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    /*
     *Specify Model Class Name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /*
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /*
     * Store user
     * @param array $payload
     * @return bool
     */
    public function store($payload = [])
    {
        $id = $this->model->insertGetId([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => bcrypt($payload['password']),
            'is_super' => $payload['is_super']
        ]);

        if(!$id){
            return false;
        }

        if($id && ($roles = array_get($payload, 'roles'))){
            $this->attachRoles($id, $roles);
        }
        return true;
    }

    /*
     * Update User
     * @param array $attributes
     * @param $id
     * @return array
     */

    public function edit($id)
    {
        $user = $this->model->find($id);

        if(! is_null($user)){

            $role = $user->roles()->first();

            $data['id'] = $user->id;
            $data['name'] = $user->name;
            $data['username'] = $user->username;
            $data['is_super'] = $user->is_super;
            $data['role_id'] = $role->id;

            return $data;
        }

        return null;
    }

    /*
     *Delete User
     * @param $id
     * @return boot|int
     */

    public function delete($id)
    {
        $user = $this->model->find($id);
        if(!$user){
            return false;
        }
        $user->roles()->detach();
        return parent::delete($id);
    }

    /*
     * Attach user roles by user id
     * @param $userId
     * @param $roles
     */

    public function attachRoles($userId, $roles)
    {
        $user = $this->model->find($userId);
        $user->attachRoles($roles);
    }
}