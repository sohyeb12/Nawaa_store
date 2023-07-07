<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'name' , 'slug' , 'price' , 'compare_price' , 'description',
        'short_description' , 'category_id' , 'status','image','user_id'
    ];

    // protected static function booted()
    // {
    //     // booted function applied a global scope for the queries 
    //     static::addGlobalScope('owner', function(Builder $query){
    //         $query->where('products.user_id','=', Auth::id());
    //     });
        
    // }

    public function scopeFilter(Builder $query, $filters){
        $query->when($filters['search'] ?? false , function($query , $value){
            $query->where(function ($query) use ($value){
                $query->where('products.name' , 'LIKE' , "%{$value}%")
            ->orWhere('products.description' , 'LIKE' , "%{$value}%");
            });
        })
        ->when($filters['status'] ?? false , function($query , $value){
            $query->where('products.status' , '=' , $value);
        })
        ->when($filters['category_id'] ?? false , function ($query , $value){
            $query->where('products.category_id' , '=' , $value);
        })
        ->when($filters['price_min'] ?? false , function ($query , $value){
            $query->where('products.price' , '>=' , $value);
        })
        ->when($filters['price_max'] ?? false , function ($query , $value){
            $query->where('products.price' , '<=' , $value);
        });
    }

    public function category(){
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Uncategorized',
            ]);
    }

    public function cart(){
        return $this->belongsToMany(
            User::class,     // Related Model (Product)
            'carts',         // Pivot table (defualt= product_user)
            'product_id',   // FK current in model in pivot table
            'user_id',      // FK related model in pivot table
            'id',           // PK current model 
            'id',           // PK for related model
        )->withPivot(['quantity'])
        ->withTimestamps()
        ->using(Cart::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function scopeActive(Builder $query){
        $query->where('status', '=' , 'active');
    }

    public function scopeStatus(Builder $query , $status){
        $query->where('status', '=' , $status);
    }

    public static function status_option(){
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }

    public function getImageUrlAttribute(){
        if($this->image){
            return Storage::disk('public')->url($this->image);
        }   
        return 'https://placehold.co/600x600';
    }

    public function getNameAttribute($value){
        return ucwords($value);
    }

    public function getPriceFormattedAttribute(){
        $formatter = new NumberFormatter('en',NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price,'USD');
    }

    public function getComparePriceFormattedAttribute(){
        $formatter = new NumberFormatter('en',NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->compare_price,'USD');
    }

    public function gallery(){
        return $this->hasMany(ProductImage::class);
    }
}
