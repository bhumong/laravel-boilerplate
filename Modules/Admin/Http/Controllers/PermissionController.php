<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\RoleUpdateRequest;
use Modules\Admin\Http\Resources\Collection\DataTableResourceCollection;
use Modules\Admin\Http\Resources\Json\RoleResource;
use Modules\Admin\Repositories\RoleRepository;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin::pages/permission/index');
    }

    public function indexData(RoleRepository $roleRepository)
    {
        return new DataTableResourceCollection($roleRepository, RoleResource::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        return view('admin::pages/role/form', [
            'role' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function edit(Role $role)
    {
        return view('admin::pages/role/form', [
            'role' => $role
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role, RoleRepository $roleRepository)
    {
        $updateData = $request->all();
        $roleRepository->update($role, $updateData);
        return redirect()->route('admin/roles/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
