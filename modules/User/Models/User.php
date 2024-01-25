<?php

namespace User\Models;

use Course\Models\Course;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Media\Models\Media;
use RolePermissions\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use User\Notifications\ResetPasswordRequestNotification;
use User\Notifications\VerifyMailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';
    static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_BAN];


    static $defaultUsers = [
        [
            'email' => 'admin@gmail.com',
            'password' => 'demo',
            'name' => 'Admin',
            'role' => Role::ROLE_SUPER_ADMIN
        ],
    ];



    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'username',
        'mobile',
        'headline',
        'website',
        'linkedin',
        'facebook',
        'twitter',
        'youtube',
        'instagram',
        'telegram',
        'status',
        'image_id',
        'password',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyMailNotification());
    }

    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }
}
