<?php

namespace Modules\Admin\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\role\PermissionStoreRequest;
use Modules\Admin\Http\Requests\role\PermissionUpdateRequest;
use Modules\Admin\Transformers\PermissionResource;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionController extends Controller
{
    private function guard(): string
    {
        return config('admin.permission_guard', 'sanctum');
    }

    public function index(Request $request)
    {
        $guard = $this->guard();
        $perPage = (int) $request->integer('per_page', 15);

        $perms = QueryBuilder::for(Permission::query()->where('guard_name', $guard))
            ->allowedSorts(['id','name','created_at'])
            ->allowedFilters([
                AllowedFilter::partial('name'),
            ])
            ->paginate($perPage)
            ->appends($request->query());

        return PermissionResource::collection($perms);
    }

    public function store(PermissionStoreRequest $request)
    {
        $guard = $this->guard();
        $data = $request->validated();

        $perm = Permission::findOrCreate($data['name'], $guard);

        return (new PermissionResource($perm))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Permission $permission)
    {
        $guard = $this->guard();
        abort_unless($permission->guard_name === $guard, 404);

        return new PermissionResource($permission);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $guard = $this->guard();
        abort_unless($permission->guard_name === $guard, 404);

        $data = $request->validated();

        if (array_key_exists('name', $data)) {
            $exists = Permission::query()
                ->where('guard_name', $guard)
                ->where('name', $data['name'])
                ->where('id', '!=', $permission->id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' => 'Permission name already exists.',
                ], 422);
            }

            $permission->name = $data['name'];
        }

        $permission->save();

        return new PermissionResource($permission);
    }

    public function destroy(Permission $permission)
    {
        $guard = $this->guard();
        abort_unless($permission->guard_name === $guard, 404);

        $permission->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
