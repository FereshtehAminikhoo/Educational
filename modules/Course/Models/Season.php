<?php

namespace Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Season extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'number',
        'confirmation_status'
    ];


    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];


    const STATUS_OPENED = 'opened';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED ];



    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
