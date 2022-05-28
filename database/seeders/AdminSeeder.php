<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
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

    }
}
