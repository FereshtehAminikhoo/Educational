<?php

namespace Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Models\Media;
use User\Models\User;

class Lesson extends Model
{
    use HasFactory;


    protected $guarded = [];


    protected $fillable = [
        'course_id',
        'season_id',
        'user_id',
        'media_id',
        'title',
        'slug',
        'free',
        'body',
        'time',
        'number',
        'confirmation_status',
        'status',
    ];


    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];


    const STATUS_OPENED = 'opened';
    const STATUS_LOCKED = 'locked';
    static $statuses = [self::STATUS_OPENED, self::STATUS_LOCKED ];


    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function getConfirmationStatusCssClass()
    {
        if($this->confirmation_status == self::CONFIRMATION_STATUS_ACCEPTED) return "text-success";
        elseif($this->confirmation_status == self::CONFIRMATION_STATUS_REJECTED) return "text-error";
    }
}
