<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function loginPage()
    {
        if (auth()->user()) {
            return redirect()->route('admin/dashboard');
        }
        return view('admin::pages/auth/login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('admin/dashboard');
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin/login');
    }
}
