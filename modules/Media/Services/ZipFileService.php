<?php

namespace Media\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Media\Contracts\FileServiceContract;
use Media\Models\Media;

class ZipFileService extends DefaultFileService implements FileServiceContract
{
    public static function upload(UploadedFile $file, $filename, $dir) :array
    {
        Storage::putFileAs($dir, $file, $filename . '.' . $file->getClientOriginalExtension());
        return ['zip' => $filename . '.' . $file->getClientOriginalExtension()];
    }

    public static function thumb(Media $media)
    {
        return url('/img/zip-thumb.jpg');
    }
}
