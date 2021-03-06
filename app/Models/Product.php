<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','price','discount','description','quantity','status','category','avater','images'
    ];

    public function review(){
        return $this->hasMany(Review::class);
    }
}

