<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BLOCKED = 'blocked';
    
    const USER_TYPE = 'user';
    const ADMIN_TYPE = 'admin';
    const SUPER_ADMIN_TYPE = 'super-admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
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
        'password' => 'hashed',
    ];

    public function profile(){
        return $this->hasOne(Profile::class)->withDefault();
    }

    public static function status_option(){
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'In-Active',
            self::STATUS_BLOCKED => 'Blocked',
        ];
    }

    public static function user_types(){
        return [
            self::USER_TYPE => 'User',
            self::ADMIN_TYPE => 'Admin',
            self::SUPER_ADMIN_TYPE => 'Super-Admin',
        ];
    }
    
}
