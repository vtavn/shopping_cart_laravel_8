<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $lists = $this->category->latest()->paginate(5);

        return view('admin.categories.lists', compact('lists'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.categories.add', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|unique:categories,name',
            'parent_id' => 'integer'
        ],
        [
            'name.required' => 'Tên chuyên mục bắt buộc phải nhập',
            'name.unique' => 'Tên chuyên mục đã tồn tại',
            'parent_id.integer' => 'Danh mục cha không hợp lệ'

        ]);

        $this->category->create([
           'name' => $request->name,
           'parent_id' => $request->parent_id,
            'slug' => create_slug($request->name)
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Thêm Chuyên mục thành công');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.categories.edit', compact('category', 'htmlOption'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'. $request->id,
            'parent_id' => 'integer'
        ],
            [
                'name.required' => 'Tên chuyên mục bắt buộc phải nhập',
                'name.unique' => 'Tên chuyên mục đã tồn tại',
                'parent_id.integer' => 'Danh mục cha không hợp lệ'

            ]);

        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => create_slug($request->name)
        ]);

        return back()->with('msg', 'Cập nhật thành công.');
    }

    public function delete($id)
    {
        $this->category->find($id)->delete();
        return back()->with('msg', 'Xoá thành công.');
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecusive($parentId);

        return $htmlOption;
    }
}
