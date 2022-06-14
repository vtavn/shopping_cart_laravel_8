<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->paginate(10);

        return view('admin.users.lists', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.add', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users,email',
           'password' => 'required',
            'role' => 'required'
        ],
        [
            'required' => ':attribute bắt buộc phải nhập.',
            'email' => ':attribute không đúng định dạng.',
            'unique' => ':attribute đã tồn tại.'
        ],
        [
            'name' => 'Họ tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'role' => 'Vai trò'
        ]);

        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            //insert role_user
            $user->roles()->attach($request->role);
            DB::commit();
            return redirect()->route('admin.users.index')->with('msg', 'Thêm người dùng mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage().' Line: '.$exception->getLine());
            return back()->with('err', 'Lỗi Máy chủ vui lòng thử lại sau.');
        }
    }

    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $id,
            'role' => 'required'
        ],
            [
                'required' => ':attribute bắt buộc phải nhập.',
                'email' => ':attribute không đúng định dạng.',
                'unique' => ':attribute đã tồn tại.'
            ],
            [
                'name' => 'Họ tên',
                'email' => 'Email',
                'role' => 'Vai trò'
            ]);

        try {
            DB::beginTransaction();
            $user = $this->user->find($id);
            $newPassword = $user->password;

            if (!empty($request->password)){
                $newPassword = Hash::make($request->password);
            }

            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $newPassword
            ]);

            //insert role_user
            $user->roles()->sync($request->role);

            DB::commit();
            return redirect()->route('admin.users.index')->with('msg', 'Cập nhật người dùng thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage().' Line: '.$exception->getLine());
            return back()->with('err', 'Lỗi Máy chủ vui lòng thử lại sau.');
        }
    }

    public function delete($id)
    {
        try {
            $this->user->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            Log::error('Message: '. $exception->getMessage().' Line: '.$exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
