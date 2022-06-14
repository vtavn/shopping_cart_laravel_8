<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminRoleController extends Controller
{
    //
    public function index()
    {
        $lists = Role::paginate(10);
        return view('admin.roles.lists', compact('lists'));
    }

    public function create()
    {
        $permissionsParent = Permission::where('parent_id', 0)->get();

        return view('admin.roles.add', compact('permissionsParent'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ],
        [
            'name.required' => ':attributes bắt buộc phải nhập.',
            'display_name.required' => ':attributes bắt buộc phải nhập.'
        ]);
        Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ])->permissions()->attach($request->permission_id);

        return redirect()->route('admin.roles.index')->with('msg', 'Thêm Vai trò mới thành công.');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissionsParent = Permission::where('parent_id', 0)->get();
        return view('admin.roles.edit', compact('role', 'permissionsParent'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ],
            [
                'name.required' => ':attributes bắt buộc phải nhập.',
                'display_name.required' => ':attributes bắt buộc phải nhập.'
            ]);
        Role::where('id', $id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        Role::find($id)->permissions()->sync($request->permission_id);

        return redirect()->route('admin.roles.index')->with('msg', 'Cập nhật Nhóm thành công.');
    }

    public function delete($id)
    {
        try {
            Role::find($id)->delete();
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
