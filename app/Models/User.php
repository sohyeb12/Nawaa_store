<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
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
        'image'
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
        return $this->hasOne(Profile::class)->withDefault([
            'first_name' => 'No Name',
        ]);
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

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function cart(){
        return $this->belongsToMany(
            Product::class,  // Related Model (Product)
            'carts',         // Pivot table (defualt= product_user)
            'user_id',       // FK current in model in pivot table
            'product_id',    // FK related model in pivot table
            'id',            // PK current model 
            'id',            // PK for related model
        )->withPivot(['quantity'])
        ->withTimestamps()
        ->using(Cart::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function getImageUrlAttribute(){
        if($this->image){
            return Storage::disk('public')->url($this->image);
        }   
        return 'https://placehold.co/600x600';
    }
    
}
