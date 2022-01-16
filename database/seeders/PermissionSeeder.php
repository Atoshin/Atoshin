<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        Permission::query()->create([
            'name'=> 'manage galleries',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage assets',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage artists',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage categories',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage users',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage admins',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage roles',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage permissions',
            'guard_name'=>'admin'
        ]);

        Permission::query()->create([
            'name'=> 'manage galleryings',
            'guard_name'=>'admin'
        ]);


    }
}
