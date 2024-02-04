<?php

namespace Media\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Media\Contracts\FileServiceContract;
use Media\Models\Media;

class ZipFileService implements FileServiceContract
{
    public static function upload(UploadedFile $file, $filename, $dir) :array
    {
        Storage::putFileAs($dir, $file, $filename . '.' . $file->getClientOriginalExtension());
        return ['zip' => $dir . $filename . '.' . $file->getClientOriginalExtension()];
    }

    public static function delete(Media $media)
    {
        // TODO: Implement delete() method.
    }
}
