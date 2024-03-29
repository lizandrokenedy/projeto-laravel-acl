<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Role;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    protected $model = Role::class; 

    public function create(array $data):bool {

        $register = $this->model->create($data);
        if(isset($data['permissions']) && count($data['permissions'])){
            foreach($data['permissions'] as $key => $value){
                $register->permissions()->attach($value);
            }
        }

        return (bool) $register;
    }

    public function update(array $data, int $id):bool {
        $register = $this->find($id);
        if($register) {
            $permissions = $register->permissions;
            if(count($permissions)){
                foreach($permissions as $key => $value){
                    $register->permissions()->detach($value->id);
                }
            }
            if(isset($data['permissions']) && count($data['permissions'])){
                foreach($data['permissions'] as $key => $value){
                    $register->permissions()->attach($value);
                }
            }
            return (bool) $register->update($data);
        } else {
            return false;
        }

    }

}
