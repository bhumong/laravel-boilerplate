<?php

namespace Modules\Admin\Http\Controllers;


use App\Utilities\Enum\PermissionTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Http\Requests\PermissionCreateRequest;
use Modules\Admin\Http\Requests\PermissionUpdateRequest;
use Modules\Admin\Http\Resources\Collection\DataTableResourceCollection;
use Modules\Admin\Http\Resources\Json\PermissionResource;
use Modules\Admin\Repositories\PermissionRepository;
use Modules\Admin\Services\Rbac\Rbac;
use Modules\Admin\Utilities\Enum\FlashEnum;
use Modules\Admin\Utilities\Enum\PermissionSlugEnum;

class PermissionController extends Controller
{
    public function index()
    {
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('index', Permission::class);
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
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('create', Permission::class);

        $permission = new Permission();
        return view('admin::pages/permission/form', [
            'permission' => $permission
        ]);
    }

    public function store(PermissionCreateRequest $request, PermissionRepository $permissionRepository)
    {
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('create', Permission::class);

        $permissionRepository->create(array_merge($request->all(), ['type' => PermissionTypeEnum::slug->value]));
        return redirect()->route('admin/permissions/index');
    }

    public function show(Permission $permission)
    {
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('get', $permission);

        return view('admin::pages/permission/detail', [
            'permission' => $permission
        ]);
    }

    public function edit(Permission $permission)
    {
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('update', $permission);

        return view('admin::pages/permission/form', [
            'permission' => $permission
        ]);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission, PermissionRepository $permissionRepository)
    {
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('update', $permission);

        $updateData = $request->only(['description', 'is_active']);
        $permissionRepository->update($permission, $updateData);
        return redirect()->route('admin/permissions/index');
    }

    public function destroy(Permission $permission, PermissionRepository $permissionRepository)
    {
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('delete', $permission);

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

    public function generate(PermissionRepository $permissionRepository, Rbac $rbac)
    {
        /** see Modules/Admin/Policies/PermissionPolicy.php */
        $this->authorize('generate', Permission::class);

        $slugPermissions = PermissionSlugEnum::values();
        $insertData = [];
        $now = now();
        $permissionExists = $permissionRepository->getBySlug(PermissionTypeEnum::slug);
        foreach ($slugPermissions as $slugPermission) {
            $isNotExist = $permissionExists->where('permission', $slugPermission)->isEmpty();
            if ($isNotExist) {
                $insertData[] = [
                    'id' => Str::uuid(),
                    'permission' => $slugPermission,
                    'type' => PermissionTypeEnum::slug->value,
                    'is_active' => 1,
                    'created_at' => $now,
                ];
            }
        }
        if (!empty($insertData)) {
            $permissionRepository->insert($insertData);
        }
        $rbac->cache();
        session()->flash(FlashEnum::success->value, 'Success generate permissions.');
        return redirect()->route('admin/permissions/index');
    }
}
