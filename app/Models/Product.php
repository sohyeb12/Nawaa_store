<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'name' , 'slug' , 'price' , 'compare_price' , 'description',
        'short_description' , 'category_id' , 'status','image',
    ];

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
        $formatter = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price,'EUR');
    }

}
