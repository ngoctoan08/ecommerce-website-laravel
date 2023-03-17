<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait StoreImageTrait {
    public function StoreImageTraitUpload($request, $fieldName, $folderName)
    {
        if($request->hasFile($fieldName)) {
            $uploadFile = $request->file($fieldName);
            if(is_array($uploadFile)) {
                $dataMultipleImage = array();
                foreach($uploadFile as $file) {
                    $fileNameOrigin = $file->getClientOriginalName(); //name of file origin, it saved in public to view user
                    $fileNameHash = $file->hashName();
                    $filePath = $file->storeAs('public/'.$folderName, $fileNameHash); //luu vao folder voi duong dan
                    // return redirect(route('product.index')); //tro ve ham index product
                    $data = [
                        'name' => $fileNameOrigin,
                        'path' => Storage::url($filePath), 
                    ];
                    $dataMultipleImage[] = $data;
                }
                return $dataMultipleImage;
            }
            else {
                $fileNameOrigin = Str::slug($uploadFile->getClientOriginalName()) ; //name of file origin, it saved in public to view user
                $fileNameHash = $uploadFile->hashName();
                $filePath = $uploadFile->storeAs('public/'.$folderName, $fileNameHash); //luu vao folder voi duong dan
                // return redirect(route('product.index')); //tro ve ham index product
                $data = [
                    'name' => $fileNameOrigin,
                    'path' => Storage::url($filePath), 
                ];
                return $data;
            }
        }
        return null;
    }
}