<?php

namespace Course\Models;

use Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Models\Media;
use User\Models\User;

class Course extends Model
{
    use HasFactory;


    const TYPE_CASH = 'cash';
    const TYPE_FREE = 'free';
    static $types = [self::TYPE_CASH, self::TYPE_FREE];

    const STATUS_COMPLETED = 'completed';
    const STATUS_NOT_COMPLETED = 'not-completed';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCKED ];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];

    protected $guarded = [];


    protected $fillable = [
        'teacher_id',
        'category_id',
        'banner_id',
        'title',
        'slug',
        'priority',
        'price',
        'percent',
        'type',
        'status',
        'body'
    ];


    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
