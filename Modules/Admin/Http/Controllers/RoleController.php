<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Entities\Role;
use Modules\Admin\Http\Requests\RoleCreateRequest;
use Modules\Admin\Http\Requests\RoleUpdateRequest;
use Modules\Admin\Http\Resources\Collection\DataTableResourceCollection;
use Modules\Admin\Http\Resources\Json\RoleResource;
use Modules\Admin\Repositories\RoleRepository;
use Modules\Admin\Services\Rbac\Rbac;
use Modules\Admin\Utilities\Enum\FlashEnum;

class RoleController extends Controller
{

    public function search(Request $request, RoleRepository $roleRepository)
    {
        $search = $request->input('search', '');
        return [
            'results' => $roleRepository->autocomplete($search)
        ];
    }

    public function index()
    {
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('index', Role::class);

        return view('admin::pages/role/index');
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
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('create', Role::class);

        $role = new Role();
        return view('admin::pages/role/form', [
            'role' => $role
        ]);
    }

    public function store(RoleCreateRequest $request, RoleRepository $roleRepository)
    {
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('create', Role::class);

        $data = $request->except('permissions');
        $data['permission_ids'] = $request->input('permissions', []);
        $roleRepository->create($data);
        return redirect()->route('admin/roles/index');
    }

    public function show(Role $role)
    {
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('get', $role);

        return view('admin::pages/role/detail', [
            'role' => $role
        ]);
    }

    public function edit(Role $role)
    {
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('update', $role);

        return view('admin::pages/role/form', [
            'role' => $role
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role, RoleRepository $roleRepository)
    {
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('update', $role);

        $updateData = $request->except('permissions');
        $updateData['permission_ids'] = $request->input('permissions', []);
        $roleRepository->update($role, $updateData);
        return redirect()->route('admin/roles/index');
    }

    public function destroy(Role $role, RoleRepository $roleRepository)
    {
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('delete', $role);

        $roleRepository->delete($role);
        return redirect()->route('admin/roles/index');
    }

    public function applyChange(Rbac $rbac)
    {
        /** see Modules/Admin/Policies/RolePolicy.php */
        $this->authorize('applyChange', Role::class);

        $rbac->cache();
        session()->flash(FlashEnum::success->value, 'Success apply role.');
        return redirect()->route('admin/roles/index');
    }
}
