<?php

namespace Media\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Media\Contracts\FileServiceContract;

class VideoFileService extends DefaultFileService implements FileServiceContract
{
    public static function upload(UploadedFile $file, $filename, $dir) :array
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'private\\';
        Storage::putFileAs($dir, $file, $filename . '.' . $extension);
        return ['video' => $filename . '.' . $extension];
    }

}
