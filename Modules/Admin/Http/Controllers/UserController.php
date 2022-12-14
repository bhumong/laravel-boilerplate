<?php

namespace Modules\Admin\Http\Controllers;

use App\Exceptions\ApiException;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\User;
use Modules\Admin\Http\Requests\UserCreateRequest;
use Modules\Admin\Http\Requests\UserUpdateRequest;
use Modules\Admin\Http\Resources\Collection\DataTableResourceCollection;
use Modules\Admin\Http\Resources\Json\UserResource;
use Modules\Admin\Repositories\UserRepository;
use Modules\Admin\Utilities\Enum\ErrorTypeEnum;

class UserController extends Controller
{
    public function index()
    {
        return view('admin::pages/user/index');
    }

    public function indexData(UserRepository $userRepository)
    {
        return new DataTableResourceCollection($userRepository, UserResource::class);
    }

    public function create()
    {
        $user = new User();
        return view('admin::pages/user/form', [
            'user' => $user
        ]);
    }

    public function store(UserCreateRequest $request, UserRepository $userRepository)
    {
        $userRepository->create($request->all());

        return redirect()->route('admin/users/index');
    }

    public function edit(User $user)
    {
        return view('admin::pages/user/form', [
            'user' => $user
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, UserRepository $userRepository)
    {
        $userRepository->update($user, $request->all());

        return redirect()->route('admin/users/index');
    }

    public function destroy(User $user, UserRepository $userRepository)
    {
        $userLogin = auth()->user();
        if ($userLogin->id == $user->id) {
            return redirect()
                ->route('admin/users/edit', ['user' => $user->id])
                ->withErrors('cannot delete own users', ErrorTypeEnum::flashMessage->name);
        }
        $userRepository->delete($user);
        return redirect()->route('admin/users/index');
    }
}
