<?php

namespace Media\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Media\Contracts\FileServiceContract;
use Media\Models\Media;

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

    public static function thumb(Media $media)
    {
        return url('/img/video-thumb.png');
    }
}
