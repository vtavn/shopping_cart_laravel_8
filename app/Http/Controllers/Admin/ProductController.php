<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
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

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecusive($parentId);

        return $htmlOption;
    }
}
