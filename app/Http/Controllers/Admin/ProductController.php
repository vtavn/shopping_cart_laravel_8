<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Helpers\StorageImageTrait;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use StorageImageTrait;

    private $products, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->products = $product;
        $this->category = $category;

    }

    public function index()
    {
        $lists = $this->products->latest()->paginate(5);
        return view('admin.products.lists', compact('lists'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.products.add', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Tên Sản phẩm bắt buộc phải nhập.'
        ]);

        $dataProductCreate = [
          'name' => $request->name,
          'price' => $request->price,
          'content' => $request->contents,
          'user_id' => Auth::id(),
          'category_id' => $request->category_id
        ];
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

        if (!empty($dataUploadFeatureImage))
        {
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }

        $this->products->create($dataProductCreate);

        return redirect()->route('admin.products.index')->with('msg', 'Thêm sản phẩm mới thành công.');
    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecusive($parentId);

        return $htmlOption;
    }
}
