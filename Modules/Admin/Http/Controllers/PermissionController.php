<?php

namespace Modules\Admin\Http\Controllers;


use App\Utilities\Enum\PermissionTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Http\Requests\PermissionCreateRequest;
use Modules\Admin\Http\Requests\PermissionUpdateRequest;
use Modules\Admin\Http\Resources\Collection\DataTableResourceCollection;
use Modules\Admin\Http\Resources\Json\PermissionResource;
use Modules\Admin\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin::pages/permission/index');
    }

    public function indexData(PermissionRepository $permissionRepository)
    {
        return new DataTableResourceCollection($permissionRepository, PermissionResource::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = new Permission();
        return view('admin::pages/permission/form', [
            'permission' => $permission
        ]);
    }

    public function store(PermissionCreateRequest $request, PermissionRepository $permissionRepository)
    {
        $permissionRepository->create(array_merge($request->all(), ['type' => PermissionTypeEnum::slug->value]));
        return redirect()->route('admin/permissions/index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('admin::pages/permission/form', [
            'permission' => $permission
        ]);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission, PermissionRepository $permissionRepository)
    {
        $updateData = $request->all();
        $permissionRepository->update($permission, $updateData);
        return redirect()->route('admin/permissions/index');
    }

    public function destroy(Permission $permission, PermissionRepository $permissionRepository)
    {
        $permissionRepository->delete($permission);
        return redirect()->route('admin/permissions/index');
    }

    public function search(PermissionRepository $permissionRepository, Request $request)
    {
        $search = $request->input('search', '');
        return [
            'results' => $permissionRepository->autocomplete($search)
        ];
    }
}
