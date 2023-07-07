<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'product_id',
        'user_review',
        'review_rating',
    ];

    public function product(){
        $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'No Name',
        ]);
    }

    public function CountReviews($id,$value){
        return Review::where('review_rating' , '=' , $value)->where('product_id' , '=' , $id)->count();
    }

    public function ComputeAverage($id){
        $num = Review::select('review_rating')->where('product_id' , '=' , $id)->count();
        $sum = Review::where('product_id' , '=' , $id)->sum('review_rating');
        
        if($num > 0 )
            return number_format( (($sum/($num  * 5)) * 5),1);
        else 
            return 'has not reviews';

    }
}
