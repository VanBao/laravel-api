<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\City;
use Illuminate\Support\Facades\Log;
use Debugbar;
class LoginController extends WebDriverController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['showLoginForm', 'login']]);
    }

    public function showLoginForm(Request $request)
    {
        if (auth()->check()) return $this->redirectIfLogged();
        return view('login');
    }

    public function login(Request $request)
    {
        if (auth()->check()) return $this->redirectIfLogged();

        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255|min:6'
        ]);

        $credentials = request(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return redirect()->route('login')->withErrors(['Sai tài khoản hoặc mật khẩu !']);
        } else {
            if (session()->has('return_to_booking_id') && session('return_to_booking_id')) {
                if(auth()->user()->group->type == 'staff') {
                    return redirect()->route('admin.staff.detail', ['id' => session('return_to_booking_id'), 'destroy_session' => 'yes']);
                } else if(auth()->user()->group->type == 'super_admin' || auth()->user()->group->type == 'admin') {
                    return redirect()->route('admin.booking.detail', ['id' => session('return_to_booking_id'), 'destroy_session' => 'yes']);
                }
            }
            if (auth()->user()->group->type == 'staff') return redirect()->route('admin.staff.index');
            else return redirect()->route('admin.dashboard.index');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        session()->forget('roles');
        return redirect()->route('login');
    }

    private function redirectIfLogged()
    {
        if (auth()->user()->group->type == 'staff') return redirect()->route('admin.staff.index');
        else return redirect()->route('admin.dashboard.index');
    }
}
