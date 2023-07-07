<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    use HasFactory;
    use HasUuids;

    protected $table = 'carts';

    protected $fillable = [
        'cooke_id','user_id' , 'product_id','quantity'
    ];

    // public function uniqueIds(){
    //     return [
    //         'id','cookie_id'
    //     ];
    // }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
