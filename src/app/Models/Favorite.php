<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Shop;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','shop_id'];

    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }
}
