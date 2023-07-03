<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory , SoftDeletes;

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
}
