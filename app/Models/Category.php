<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name','image',
    ];
    public function getNameAttribute($value){
        return ucwords($value);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    // protected static function booted()
    // {
    //     // booted function applied a global scope for the queries 
    //     static::addGlobalScope('owner', function(Builder $query){
    //         $query->where('user_id','=', Auth::id());
    //     });
        
    // }

    public function getImageUrlAttribute(){
        if($this->image){
            return Storage::disk('public')->url($this->image);
        }   
        return 'https://placehold.co/600x600';
    }
}
