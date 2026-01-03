<?php

namespace Modules\Admin\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\role\RoleStoreRequest;
use Modules\Admin\Http\Requests\role\RoleUpdateRequest;
use Modules\Admin\Http\Requests\role\RoleSyncPermissionsRequest;
use Modules\Admin\Transformers\RoleResource;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RoleController extends Controller
{
    private function guard(): string
    {
        return config('admin.permission_guard', 'sanctum');
    }

    public function index(Request $request)
    {
        $guard = $this->guard();
        $perPage = (int) $request->integer('per_page', 15);

        $roles = QueryBuilder::for(Role::query()->where('guard_name', $guard))
            ->allowedIncludes(['permissions'])
            ->allowedSorts(['id','name','created_at'])
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::scope('search'), // optional if you define scopeSearch on model (not required)
            ])
            ->paginate($perPage)
            ->appends($request->query());

        // if include=permissions => eager load already handled by allowedIncludes
        return RoleResource::collection($roles);
    }

    public function store(RoleStoreRequest $request)
    {
        $guard = $this->guard();
        $data = $request->validated();

        $role = Role::firstOrCreate([
            'name' => $data['name'],
            'guard_name' => $guard,
        ]);

        if (!empty($data['permissions']) && is_array($data['permissions'])) {
            $perms = [];
            foreach ($data['permissions'] as $permName) {
                $perms[] = Permission::findOrCreate($permName, $guard);
            }
            $role->syncPermissions($perms);
        }

        $role->load('permissions');

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Role $role, Request $request)
    {
        $guard = $this->guard();

        abort_unless($role->guard_name === $guard, 404);

        if ($request->query('include')) {
            $role->load(array_filter(explode(',', (string) $request->query('include'))));
        }

        return new RoleResource($role);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $guard = $this->guard();
        abort_unless($role->guard_name === $guard, 404);

        $data = $request->validated();
        if (array_key_exists('name', $data)) {
            // prevent duplicate role name in same guard
            $exists = Role::query()
                ->where('guard_name', $guard)
                ->where('name', $data['name'])
                ->where('id', '!=', $role->id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Role name already exists.',
                ], 422);
            }

            $role->name = $data['name'];
        }

        $role->save();
        $role->load('permissions');

        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $guard = $this->guard();
        abort_unless($role->guard_name === $guard, 404);

        $role->delete();

        return response()->json(['message' => 'Deleted']);
    }

    public function syncPermissions(RoleSyncPermissionsRequest $request, Role $role)
    {
        $guard = $this->guard();
        abort_unless($role->guard_name === $guard, 404);

        $data = $request->validated();

        $perms = [];
        foreach ($data['permissions'] as $permName) {
            $perms[] = Permission::findOrCreate($permName, $guard);
        }

        $role->syncPermissions($perms);
        $role->load('permissions');

        return new RoleResource($role);
    }
}
