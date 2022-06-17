<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminPermissionController extends Controller
{
    //
    public function index()
    {
        $lists = Permission::where('parent_id', 0)->latest()->paginate(10);
        return view('admin.permissions.lists', compact('lists'));
    }

    public function create()
    {
        return view('admin.permissions.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'display_name' => 'required'
        ]);

        $module = Permission::create([
            'name' => $request->name,
            'display_name' =>  $request->display_name,
            'parent_id' => 0
        ]);

        $moduleArr = [
            'view' => 'Xem',
            'create' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xoá'
        ];

        foreach ($moduleArr as $key => $moduleItem)
        {
            Permission::create([
                'name' => $key,
                'display_name' =>  $moduleItem,
                'parent_id' => $module->id
            ]);
        }

        return redirect()->route('admin.permissions.index')->with('msg', 'Thêm thành công module mới.');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Permission $permission, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->name,
            'display_name' => 'required'
        ]);

        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->save();

        return redirect()->route('admin.permissions.index')->with('msg', 'Cập nhật thành công.');

    }

    public function delete(Permission $permission)
    {
        try {
            $permissionList = Permission::where('parent_id', $permission->id)->get();
            Permission::destroy($permissionList);
            Permission::destroy($permission->id);
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
