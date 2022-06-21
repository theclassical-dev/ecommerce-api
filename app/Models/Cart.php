<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid','user_name','product_id','product_name','product_price','product_image','product_image_url'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
