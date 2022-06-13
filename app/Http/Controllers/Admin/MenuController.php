<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index()
    {
        $lists = $this->menu->latest()->paginate(5);
        return view('admin.menus.lists', compact('lists'));
    }

    public function create()
    {
        $htmlOption = $this->getMenus($parentId = '');
        return view('admin.menus.add', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menus,name',
            'parent_id' => 'integer'
        ],
        [
            'name.required' => 'Tên menu không được để trống.',
            'name.unique' => 'Tên menu đã tồn tại.',
            'parent_id' => 'Menu cha không hợp lệ.'
        ]);

        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.menus.index')->with('msg', 'Thêm menu mới thành công.');
    }

    public function edit($id)
    {
        $menu = $this->menu->find($id);
        $htmlOption = $this->getMenus($menu->parent_id);
        return view('admin.menus.edit', compact('htmlOption', 'menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:menus,name,'.$request->id,
            'parent_id' => 'integer'
        ],
            [
                'name.required' => 'Tên menu không được để trống.',
                'name.unique' => 'Tên menu đã tồn tại.',
                'parent_id' => 'Menu cha không hợp lệ.'
            ]);

        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.menus.index')->with('msg', 'Cập nhật menu thành công.');
    }

    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return back()->with('msg', 'Xoá thành công menu.');
    }

    public function getMenus($parentId)
    {
        $data = $this->menu->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecusive($parentId);

        return $htmlOption;
    }
}
