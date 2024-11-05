<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function show(Request $request){
        $shopId = $request->shopId;
        $user = Auth::guard('users')->user();
        if($user){
            $userId = $user->id;
        }else{
            $userId = '';
        }

        $shop = Shop::where('id','=',$shopId)
            ->first();
        $reviews = Review::where('user_id','=',$userId)
            ->where('shop_id','=',$shopId)
            ->first();

        return view('user.detail',['shop'=>$shop,'reviews'=>$reviews]);
    }

    public function store(Request $request){
        $shopId = $request->shopId;
        $userId = $request->userId;
        $date = $request->date;
        $time = $request->time;
        $strGestCount = $request->num;
        $gestCount = preg_replace("/[^0-9]/", "", $strGestCount);
        $reservation_date = new Carbon($date.' '.$time);

        Reservation::create([
            'user_id'=>$userId,
            'shop_id'=>$shopId,
            'reservation_guest_count'=>$gestCount,
            'reservation_date'=>$reservation_date
        ]);

        return view('user.done');
    }
}
