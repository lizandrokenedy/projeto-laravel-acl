<?php

use Illuminate\Database\Seeder;

class AddACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Role::firstOrCreate(['name'=>'Admin'], [
            'description'=>'Função de Administrador',
        ]);

        $gerente = \App\Role::firstOrCreate(['name'=>'Gerente'], [
            'description'=>'Função de Gerenciar',
        ]);

        $userAdmin = \App\User::find(1);
        $userGerente = \App\User::find(2);

        $userAdmin->roles()->attach($admin);
        $userGerente->roles()->attach($gerente);

        $listUser = \App\Permission::firstOrCreate(['name'=>'list-user'], [
            'description'=>'Listar registros'
        ]);
        $createUser = \App\Permission::firstOrCreate(['name'=>'create-user'], [
            'description'=>'Criar registro'
        ]);
        $showUser = \App\Permission::firstOrCreate(['name'=>'show-user'], [
            'description'=>'Visualizar registro'
        ]);
        $editUser = \App\Permission::firstOrCreate(['name'=>'edit-user'], [
            'description'=>'Editar registro'
        ]);
        $deleteUser = \App\Permission::firstOrCreate(['name'=>'delete-user'], [
            'description'=>'Deletar registro'
        ]);

        $acessoAcl = \App\Permission::firstOrCreate(['name'=>'acl'], [
            'description'=>'Acesso ao ACL'
        ]);

        $gerente->permissions()->attach($listUser);
        $gerente->permissions()->attach($createUser);
    }
}
