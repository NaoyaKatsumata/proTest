<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','shop_id','score','comment','img_path'];

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
