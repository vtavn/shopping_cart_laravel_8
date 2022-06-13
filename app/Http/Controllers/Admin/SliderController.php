<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageImageTrait;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    use StorageImageTrait;
    private $sliders;

    public function __construct(Slider $slider)
    {
        $this->sliders = $slider;
    }

    public function index()
    {
        $lists = $this->sliders->latest()->paginate(5);
        return view('admin.sliders.lists', compact('lists'));
    }

    public function create()
    {
        return view('admin.sliders.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:10',
            'description' => 'required',
            'image_path' => 'required'
        ],
        [
            'name.required' => 'Tên bắt buộc phải có.',
            'name.max' => 'Tên tối đa :max ký tự',
            'name.min' => 'Tên tối thiểu :min ký tự',
            'description.required' => 'Mô tả bắt buộc phải nhập.',
            'image_path.required' => 'Ảnh Bắt Buộc phải có.'
        ]);

        try {
            $dataSliderCreate = [
                'name' => $request->name,
                'description' => $request->description
            ];

            $dataUploadSliderImage = $this->storageTraitUpload($request, 'image_path', 'sliders');

            if (!empty($dataUploadSliderImage)) {
                $dataSliderCreate['image_name'] = $dataUploadSliderImage['file_name'];
                $dataSliderCreate['image_path'] = $dataUploadSliderImage['file_path'];
            }

            $this->sliders->create($dataSliderCreate);

            return redirect()->route('admin.sliders.index')->with('msg', 'Thêm slider thành công.');
        } catch (\Exception $exception) {
            Log::error('Message: '.$exception->getMessage().' Line: '.$exception->getLine());

        }
    }

    public function edit($id)
    {
        $data = $this->sliders->find($id);
        return view('admin.sliders.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|min:10',
            'description' => 'required',
        ],
            [
                'name.required' => 'Tên bắt buộc phải có.',
                'name.max' => 'Tên tối đa :max ký tự',
                'name.min' => 'Tên tối thiểu :min ký tự',
                'description.required' => 'Mô tả bắt buộc phải nhập.',
            ]);

        $dataSliderCreate = [
            'name' => $request->name,
            'description' => $request->description
        ];

        if (!empty($request->image_path)){
            $fileImage = public_path($this->sliders->find($id)->image_path);
            Storage::delete($fileImage);

            $dataUploadSliderImage = $this->storageTraitUpload($request, 'image_path', 'sliders');
            if (!empty($dataUploadSliderImage))
            {
                $dataSliderCreate['image_name'] = $dataUploadSliderImage['file_name'];
                $dataSliderCreate['image_path'] = $dataUploadSliderImage['file_path'];
            }

        }
        $this->sliders->find($id)->update($dataSliderCreate);

        return redirect()->route('admin.sliders.index')->with('msg', 'Sửa slider thành công.');
    }

    public function delete($id)
    {
        try {
            $this->sliders->find($id)->delete();
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
