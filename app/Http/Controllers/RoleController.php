<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::query()->orderBy("created_at","desc")->get();
        return view('admin.role.index',['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Role::query()->create([
            'name' => $request->name,
            'guard_name' =>'admin',
        ]);


        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::find($id);

        return view('admin.role.edit', compact( 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $role =Role::find($id);
        $role->name=$request->name;
        $role->save();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role =Role::find($id);
        $role->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }

    public function rolepermissionpage(\Spatie\Permission\Models\Role $role)
    {

        $permissions = Permission::all();
        $role_permissions = $role->getPermissionNames()->toArray();
        return view('admin.rolepermission.create', compact('permissions', 'role','role_permissions'));

    }


    public function  storePermissions(\Spatie\Permission\Models\Role $role, Request $request) {


        $validatedData = $request->validate([

            'permissions' => 'array',
            'permissions.#' => 'exists:permissions,id',
        ]);
        if ($request->permissions)
        {
            foreach ($request->permissions as $permission)
            {
                $role->givePermissionTo($permission);
            }
        }



        return redirect()->route('roles.index')->with('message', 'Accepted successfully');
    }

    public function adminrolespage(Admin $admin)
    {
        $admin_roles = $admin->getRoleNames()->toArray();

        $roles = Role::all();
        return view('admin.admin.role',compact('admin','roles','admin_roles'));
    }

    public function storeadminroles(Admin $admin,Request $request)
    {
        $admin->syncRoles($request->roles);
        return redirect()->route('admins.index');
    }



}
