<?php

namespace Database\Seeders;

use App\Models\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::query()->where('username','atoshin')->first();
        $permissions = Permission::all();

        $role = Role::query()->create([
            'name'=>'SuperAdmin',
            'guard_name'=>'admin'
        ]);


        foreach($permissions as $permission)
        {
            DB::table('role_has_permissions')->insert([
                'role_id'=>$role->id,
                'permission_id'=>$permission->id
            ]);

            DB::table('model_has_permissions')->insert([
                'model_id'=>$admin->id,
                'model_type'=>Admin::class,
                'permission_id'=>$permission->id
            ]);

        }



        DB::table('model_has_roles')->insert([
            'role_id'=>$role->id,
            'model_id'=>$admin->id,
            'model_type'=> Admin::class
        ]);


    }
}
