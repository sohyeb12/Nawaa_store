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

    protected $fillable = [
        'cookie_id','user_id' , 'product_id','quantity'
    ];

    public function uniqueId(){
        return [
            'id','cookie_id'
        ];
    }
}
