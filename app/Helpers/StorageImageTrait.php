<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait StorageImageTrait {

    public function storageTraitUpload($request, $fieldName, $dirUpload)
    {
        if ($request->hasFile($fieldName))
        {
            $file = $request->file($fieldName);
            $fileNameOrigin = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $fileNameHash = md5(now()).'.'.$fileExtension;
            $filePath = $file->storeAs('public/'.$dirUpload.'/'. date('Y') .'/'. date('m'). '/'. date('d'). '/'. Auth::id() , $fileNameHash);

            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }

        return null;
    }

    public function storageTraitUploadMutiple($file, $dirUpload)
    {
            $fileNameOrigin = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $fileNameHash = md5(now()).'.'.$fileExtension;
            $filePath = $file->storeAs('public/'.$dirUpload.'/'. date('Y') .'/'. date('m'). '/'. date('d'). '/'. Auth::id() , $fileNameHash);

            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
    }

}
