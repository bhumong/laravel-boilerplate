<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Entities\User;
use Modules\Admin\Http\Requests\UserCreateRequest;
use Modules\Admin\Http\Requests\UserUpdateRequest;
use Modules\Admin\Http\Resources\Collection\DataTableResourceCollection;
use Modules\Admin\Http\Resources\Json\UserResource;
use Modules\Admin\Repositories\UserRepository;
use Modules\Admin\Utilities\Enum\FlashEnum;

class UserController extends Controller
{
    public function index()
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('index', User::class);
        return view('admin::pages/user/index');
    }

    public function indexData(UserRepository $userRepository)
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('index', User::class);
        return new DataTableResourceCollection($userRepository, UserResource::class);
    }

    public function create()
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('create', User::class);

        $user = new User();
        return view('admin::pages/user/form', [
            'user' => $user
        ]);
    }

    public function store(UserCreateRequest $request, UserRepository $userRepository)
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('create', User::class);

        $userRepository->create($request->all());

        return redirect()->route('admin/users/index');
    }

    public function edit(User $user)
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('update', $user);

        return view('admin::pages/user/form', [
            'user' => $user
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, UserRepository $userRepository)
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('update', $user);

        $userRepository->update($user, $request->all());

        return redirect()->route('admin/users/index');
    }

    public function destroy(User $user, UserRepository $userRepository)
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('delete', $user);

        $userLogin = auth()->user();
        if ($userLogin->id == $user->id) {
            return redirect()
                ->route('admin/users/edit', ['user' => $user->id])
                ->withErrors('cannot delete own users', FlashEnum::error->value);
        }
        $userRepository->delete($user);
        return redirect()->route('admin/users/index');
    }

    public function show(User $user)
    {
        /** see Modules/Admin/Policies/UserPolicy.php */
        $this->authorize('get', $user);

        return view('admin::pages/user/detail', [
            'user' => $user
        ]);
    }
}
