<?php

namespace Media\Contracts;

use Illuminate\Http\UploadedFile;
use Media\Models\Media;

interface FileServiceContract
{
    public static function upload(UploadedFile $file, string $filename, string $dir) :array;

    public static function delete(Media $media);
}
