<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        if (!Auth::check())
        {
            return redirect()->route('admin.login');

        }
        return view('admin.home');
    }

    public function loginAdmin()
    {
        if (Auth::check())
        {
            return redirect()->route('admin.index');
        }
        return view('admin.pages.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            return redirect()->route('admin.index')->with('msg', 'Đăng nhập thành công.');
        }
        return back()->with('errors', 'Sai tên tài khoản hoặc mật khẩu.');
    }

    public function isLogin()
    {
        if (Auth::check())
        {
            return true;
        }
        return false;
    }
}
