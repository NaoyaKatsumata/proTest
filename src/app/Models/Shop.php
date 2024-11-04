<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Category;
use App\Models\Review;

class Shop extends Model
{
    use HasFactory;
    protected $fillable=['shop_name','detail','category_id','img_path','area_id'];

    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function scores()
    {
        return $this->hasMany(Review::class);
    }
}
