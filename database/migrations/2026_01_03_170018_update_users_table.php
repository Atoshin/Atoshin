<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'password')) {
                $table->string('password')->nullable()->after('username');
            }

            if (!Schema::hasColumn('users', 'is_admin')) {
                $table->boolean('is_admin')->default(false)->after('remember_token');
            }

            if (!Schema::hasColumn('users', 'blocked')) {
                $table->boolean('blocked')->default(false)->after('is_admin');
            }
        });

        // 2) Move admins -> users (if admins table exists)
        if (Schema::hasTable('admins')) {
            $admins = DB::table('admins')->get();

            foreach ($admins as $admin) {
                // Try match by email first (if exists), else by username
                $existingUser = null;

                if (!empty($admin->email)) {
                    $existingUser = DB::table('users')->where('email', $admin->email)->first();
                }

                if (!$existingUser && !empty($admin->username)) {
                    $existingUser = DB::table('users')->where('username', $admin->username)->first();
                }

                $payload = [
                    'email'             => $admin->email,
                    'email_verified_at' => $admin->email_verified_at,
                    'username'          => $admin->username,
                    'password'          => $admin->password,
                    'remember_token'    => $admin->remember_token,
                    'is_admin'          => true,
                    'blocked'           => (bool) $admin->blocked,
                    'updated_at'        => $admin->updated_at ?? now(),
                ];

                if ($existingUser) {
                    if (empty($existingUser->password) && !empty($admin->password)) {
                        // keep payload password
                    } else {
                        unset($payload['password']);
                    }

                    DB::table('users')->where('id', $existingUser->id)->update($payload);
                } else {
                    // Insert new user as admin
                    $payload['first_name'] = null;
                    $payload['last_name']  = null;
                    $payload['avatar']     = null;
                    $payload['bio']        = null;
                    $payload['created_at'] = $admin->created_at ?? now();

                    DB::table('users')->insert($payload);
                }
            }

            // 3) Drop admins table (after migration)
            Schema::dropIfExists('admins');
        }

        // 4) Add unique indexes on users.email and users.username
        // ⚠️ اگر ایمیل/یوزرنیم تکراری داری اینجا ممکنه migrate fail بشه.
        Schema::table('users', function (Blueprint $table) {
            $table->unique('email');
            $table->unique('username');
        });
    }

    public function down(): void
    {
        // Recreate admins table (best-effort rollback)
        if (!Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('username')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->boolean('blocked')->default(false);
            });

            // Move admin users back into admins
            $adminUsers = DB::table('users')->where('is_admin', true)->get();

            foreach ($adminUsers as $u) {
                // فقط اگر email/username داریم می‌تونیم admin بسازیم
                if (empty($u->email) || empty($u->username)) {
                    continue;
                }

                DB::table('admins')->updateOrInsert(
                    ['email' => $u->email],
                    [
                        'email_verified_at' => $u->email_verified_at,
                        'username'          => $u->username,
                        'password'          => $u->password,
                        'remember_token'    => $u->remember_token,
                        'blocked'           => (bool) $u->blocked,
                        'created_at'        => $u->created_at ?? now(),
                        'updated_at'        => $u->updated_at ?? now(),
                    ]
                );
            }
        }

        // Remove unique indexes + columns we added to users
        Schema::table('users', function (Blueprint $table) {
            // drop unique indexes (Laravel default names)
            $table->dropUnique(['email']);
            $table->dropUnique(['username']);

            if (Schema::hasColumn('users', 'blocked')) {
                $table->dropColumn('blocked');
            }
            if (Schema::hasColumn('users', 'is_admin')) {
                $table->dropColumn('is_admin');
            }
            if (Schema::hasColumn('users', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};
