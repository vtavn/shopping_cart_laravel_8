<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Helpers\StorageImageTrait;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    use StorageImageTrait;

    private $products, $category, $tag, $productTag, $productImage;

    public function __construct(Product $product, Category $category, Tag $tag, ProductTag $productTag, ProductImage $productImage)
    {
        $this->products = $product;
        $this->category = $category;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productImage = $productImage;

    }

    public function index()
    {
        $lists = $this->products->latest()->paginate(10);
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
            'name' => 'required',
            'contents' => 'required',
            'price' => 'required|integer',
        ],[
            'name.required' => 'Tên Sản phẩm bắt buộc phải nhập.',
            'price.required' => 'Giá sản phẩm không được để trống.',
            'price.integer' => 'Giá sản phẩm không hợp lệ',
            'contents.required' => 'Mô tả sản phẩm không được để trống.'
        ]);

        try {
            DB::beginTransaction();

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

            $product = $this->products->create($dataProductCreate);
            //insert data to product_images
            if ($request->hasFile('image_path'))
            {
                foreach ($request->image_path as $imageItem)
                {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($imageItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //Insert tags for product
            if (!empty($request->tags))
            {
                foreach ($request->tags as $tagItem)
                {
                    //Insert to tags
                    $tagInstance = $this->tag->firstOrCreate([ 'name' => $tagItem ]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->attach($tagIds);
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('msg', 'Thêm sản phẩm mới thành công.');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage(). ' Line: '.$exception->getLine());
        }

    }

    public function edit($id)
    {
        $data = $this->products->find($id);
        $htmlOption = $this->getCategory($data->category_id);
        return view('admin.products.edit', compact('data', 'htmlOption'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contents' => 'required',
            'price' => 'required|integer',
        ],[
            'name.required' => 'Tên Sản phẩm bắt buộc phải nhập.',
            'price.required' => 'Giá sản phẩm không được để trống.',
            'price.integer' => 'Giá sản phẩm không hợp lệ',
            'contents.required' => 'Mô tả sản phẩm không được để trống.'
        ]);

        try {
            DB::beginTransaction();

            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

            if (!empty($dataUploadFeatureImage))
            {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $this->products->find($id)->update($dataProductUpdate);
            $product = $this->products->find($id);
            //insert data to product_images
            if ($request->hasFile('image_path'))
            {
                $this->productImage->where('product_id', $id)->delete();

                foreach ($request->image_path as $imageItem)
                {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($imageItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //Insert tags for product
            if (!empty($request->tags))
            {
                foreach ($request->tags as $tagItem)
                {
                    //Insert to tags
                    $tagInstance = $this->tag->firstOrCreate([ 'name' => $tagItem ]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->sync($tagIds);
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('msg', 'Sửa sản phẩm thành công.');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage(). ' Line: '.$exception->getLine());
        }

    }

    public function delete($id)
    {
        try {
            $this->products->find($id)->delete();
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

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecusive($parentId);

        return $htmlOption;
    }
}
