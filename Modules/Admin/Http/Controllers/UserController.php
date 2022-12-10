<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\User;
use Modules\Admin\Http\Requests\UserUpdateRequest;
use Modules\Admin\Http\Resources\Collection\DataTableResourceCollection;
use Modules\Admin\Http\Resources\Json\UserResource;
use Modules\Admin\Repositories\UserRepository;

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

    public function edit(User $user)
    {
        return view('admin::pages/user/detail', [
            'user' => $user
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, UserRepository $userRepository)
    {
        $updateData = $request->all();
        $userRepository->update($user, $updateData);
        return redirect()->route('admin/users/index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
