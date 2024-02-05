<?php

namespace Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Services\MediaFileService;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = [
        'user_id',
        'files',
        'type',
        'filename',
        'is_private',
    ];


    protected $casts = [
        'files' => 'json'
    ];


    protected static function booted()
    {
        static::deleting(function($media){
            MediaFileService::delete($media);
        });
    }


    public function getThumbAttribute()
    {
        return '/storage/' . $this->files[300];
    }
}
