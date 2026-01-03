<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::query()->create([
            'email' => 'info@atoshin.io',
            'username' => 'atoshin',
            'password' => '123456',
        ]);

        $permissions = [
            'admins.list',
            'admins.view',
            'admins.create',
            'admins.update',
            'admins.delete',
            'admins.make-admin',
        ];
        foreach ($permissions as $perm) {
            Permission::findOrCreate($perm, 'sanctum');
        }

        $adminRole = Role::findOrCreate('admin', 'sanctum');
        $adminRole->syncPermissions($permissions);
        $admin->syncRoles(['admin']);
    }
}
