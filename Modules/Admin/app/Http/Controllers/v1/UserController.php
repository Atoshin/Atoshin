<?php

namespace Modules\Admin\Http\Controllers\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\user\UserStoreRequest;
use Modules\Admin\Http\Requests\user\UserUpdateRequest;
use Modules\Admin\Transformers\UserResource;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $perPage = (int)$request->query('per_page', 15);
        $perPage = max(1, min($perPage, 500));
        $query = QueryBuilder::for($this->userQuery())
            ->allowedIncludes([
                'roles',
                'permissions',
            ])->with('roles', 'permissions')
            ->allowedSorts(['id', 'name', 'email', 'status', 'created_at'])
            ->defaultSort('-id')
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('email'),
                AllowedFilter::exact('status'),

                AllowedFilter::callback('search', function ($q, $value) {
                    $v = trim((string)$value);
                    if ($v === '') return;

                    $q->where(function ($qq) use ($v) {
                        $qq->where('name', 'like', "%{$v}%")
                            ->orWhere('email', 'like', "%{$v}%");
                    });
                }),
            ]);

        $paginated = $query
            ->paginate($perPage)
            ->appends($request->query());

        return UserResource::collection($paginated);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        $user = new User();
        $user->email = $data['email'];
        $user->username = $data['username'] ?? null;

        $plain = $data['password'] ?? null;
        $user->password = $plain ? Hash::make($plain) : Hash::make(str()->random(32));

        $user->is_admin = true;
        $user->save();

        // ✅ roles (from role_ids)
        if (!empty($data['role_ids']) && is_array($data['role_ids'])) {
            $roles = Role::query()
                ->whereIn('id', $data['role_ids'])
                ->where('guard_name', 'sanctum')
                ->get();

            $user->syncRoles($roles);
        }

        // ✅ permissions (optional: permission_ids)
        if (!empty($data['permission_ids']) && is_array($data['permission_ids'])) {
            $perms = Permission::query()
                ->whereIn('id', $data['permission_ids'])
                ->where('guard_name', 'sanctum')
                ->get();

            $user->syncPermissions($perms);
        }

        $user->load(['roles', 'permissions']);

        return response()->json(['data' => new UserResource($user)], 201);
    }


    public function update(UserUpdateRequest $request, User $admin)
    {
        abort_unless($this->isAdmin($admin), 404);

        $data = $request->validated();

        if (array_key_exists('email', $data)) {
            $admin->email = $data['email'];
        }

        if (array_key_exists('username', $data)) {
            $admin->username = $data['username'];
        }

        if (!empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }

        // همیشه admin نگه دار
        $admin->is_admin = true;
        $admin->save();

        // ✅ roles sync
        if (array_key_exists('role_ids', $data)) {
            $roles = Role::query()
                ->whereIn('id', $data['role_ids'] ?? [])
                ->where('guard_name', 'sanctum')
                ->get();

            $admin->syncRoles($roles);
        }

        // ✅ permissions sync
        if (array_key_exists('permission_ids', $data)) {
            $perms = Permission::query()
                ->whereIn('id', $data['permission_ids'] ?? [])
                ->where('guard_name', 'sanctum')
                ->get();

            $admin->syncPermissions($perms);
        }

        $admin->load(['roles', 'permissions']);

        return response()->json(['data' => new UserResource($admin)]);
    }

    public function show(User $admin)
    {
        // اطمینان از اینکه واقعاً admin است
        abort_unless($this->isAdmin($admin), 404);

        return new UserResource($admin);
    }


    public function destroy(User $admin)
    {
        abort_unless($this->isAdmin($admin), 404);

        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully.']);
    }


    private function userQuery()
    {
        return User::query()->where('is_admin', false);
    }

}
