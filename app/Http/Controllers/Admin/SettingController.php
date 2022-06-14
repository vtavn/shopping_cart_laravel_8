<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $lists = $this->setting->latest()->paginate(10);
        return view('admin.settings.lists', compact('lists'));
    }

    public function create()
    {
        return view('admin.settings.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'config_key' => 'required|unique:settings,config_key',
            'config_value' => 'required'
        ],
        [
            'config_key.required' => 'Config Key bắt buộc phải nhập.',
            'config_key.unique' => 'Config Key đã tồn tại.',
            'config_value.required' => 'Config Value bắt buộc phải nhập.'
        ]);

        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ]);

        return redirect()->route('admin.settings.index')->with('msg', 'Thêm Config thành công.');
    }

    public function edit($id)
    {
        $data = $this->setting->find($id);
        return view('admin.settings.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'config_key' => 'required|unique:settings,config_key,' . $id,
            'config_value' => 'required'
        ],
            [
                'config_key.required' => 'Config Key bắt buộc phải nhập.',
                'config_key.unique' => 'Config Key đã tồn tại.',
                'config_value.required' => 'Config Value bắt buộc phải nhập.'
            ]);

        $this->setting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ]);

        return redirect()->route('admin.settings.index')->with('msg', 'Cập nhật Config thành công.');
    }

    public function delete($id)
    {
        try {
            $this->setting->find($id)->delete();
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
