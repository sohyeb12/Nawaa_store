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

    protected static function booted()
    {
        // booted function applied a global scope for the queries 
        static::addGlobalScope('owner', function(Builder $query){
            $query->where('products.user_id','=', Auth::id());
        });
        
    }

    public function category(){
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Uncategorized',
            ]);
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
