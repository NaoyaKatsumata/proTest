<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;

class DetailController extends Controller
{
    public function show(Request $request){
        $shopId = $request->shopId;
        $shop = Shop::where('id','=',$shopId)
            ->first();

        return view('detail',['shop'=>$shop]);

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

        return view('done');
    }
}
