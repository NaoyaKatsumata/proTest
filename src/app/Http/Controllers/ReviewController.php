<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function show(Request $request){
        $shopId = $request->shopId;

        $user = Auth::user();
        if($user){
            $userId = $user->id;
        }else{
            $userId = '';
        }
        $favorites = Favorite::where('user_id','=',$userId)
            ->get();
        $shop = Shop::where('id','=',$shopId)
            ->first();

        return view('review',['shop'=>$shop,'favorites'=>$favorites]);
    }
}
