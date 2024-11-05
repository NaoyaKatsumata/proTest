<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function show(){
        $user = Auth::guard('users')->user();
        if($user){
            $userId = $user->id;
        }else{
            return redirect('/login');
        }
        $reservations = Reservation::with(['shop'])
            ->where('user_id','=',$userId)
            ->orderBy('reservation_date','asc')
            ->get();
        $favorites = Favorite::with(['shop'])
            ->where('user_id','=',$userId)
            ->get();
        // dd($reservations,$favorites);
        return view('user.mypage',['reservations'=>$reservations,'favorites'=>$favorites]);
    }

    public function favorite(Request $request){
        $shopId = $request->shopId;
        $user = Auth::guard('users')->user();
        if($user){
            $userId = $user->id;
        }else{
            return redirect('/login');
        }
        $favorite = Favorite::where('user_id','=',$userId)
            ->where('shop_id','=',$shopId)
            ->get();
        $count = $favorite->count();

        if($count === 0){
            Favorite::create([
                'user_id' => $userId,
                'shop_id' => $shopId
            ]);
        }else{
            $favorite = Favorite::where('user_id','=',$userId)
                ->where('shop_id','=',$shopId)
                ->delete();
        }

        return redirect('/mypage');
    }

    public function delete(Request $request){
        $reservationId = $request->reservationId;
        $userId = $request->userId;
        Reservation::where("id","=",$reservationId)
        ->delete();

        return redirect('/mypage');
    }
}
