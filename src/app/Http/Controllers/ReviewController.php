<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function show(Request $request){
        $shopId = $request->shopId;
        $user = Auth::guard('users')->user();
        if($user){
            $userId = $user->id;
        }else{
            $userId = '';
        }
        $favorites = Favorite::where('user_id','=',$userId)
            ->get();
        $shop = Shop::where('id','=',$shopId)
            ->first();

        return view('user.review',['shop'=>$shop,'favorites'=>$favorites]);
    }

    public function store(ReviewRequest $request){
        $shopId = $request->shopId;
        $user = Auth::guard('users')->user();
        if($user){
            $userId = $user->id;
        }else{
            return redirect('/review?shopId='.$shopId);
        }
        $score = $request->score;
        $comment = $request->comment;
        $review = Review::where('user_id','=',$userId)
            ->where('shop_id','=',$shopId)
            ->get();
        if($review->count() >0){
            return redirect('/review?shopId='.$shopId);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('img', 'public');
            $imgPath = Storage::url($file);
        } else {
            $imgPath = '';
        }
        
        $newReview = Review::create([
            'user_id' => $userId,
            'shop_id' => $shopId,
            'score' => $score,
            'comment' => $comment,
            'img_path' => $imgPath
        ]);

        $review = Review::where('user_id','=',$userId)
            ->where('shop_id','=',$shopId)
            ->get();

        return view('user.thanks',['review'=>$review]);
    }

    public function edit(Request $request){
        $shopId = $request->shopId;
        $user = Auth::guard('users')->user();
        if($user){
            $userId = $user->id;
        }else{
            $userId = '';
        }
        $favorites = Favorite::where('user_id','=',$userId)
            ->get();
        $shop = Shop::where('id','=',$shopId)
            ->first();
        $review = Review::where('user_id','=',$userId)
            ->where('shop_id','=',$shopId)
            ->first();

        return view('user.reviewEdit',['shop'=>$shop,'favorites'=>$favorites,'review'=>$review]);
    }

    public function delete(Request $request){
        $shopId = $request->shopId;
        $user = Auth::guard('users')->user();
        $userId = $user->id;

        Review::where('shop_id','=',$shopId)
            ->where('user_id','=',$userId)
            ->delete();
        
        return redirect('detail?shopId='.$shopId);
    }

    public function update(ReviewRequest $request){
        $shopId = $request->shopId;
        $user = Auth::guard('users')->user();
        if($user){
            $userId = $user->id;
        }else{
            return redirect('/review?shopId='.$shopId);
        }
        $score = $request->score;
        $comment = $request->comment;
        $review = Review::where('user_id','=',$userId)
            ->where('shop_id','=',$shopId)
            ->first();

        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('img', 'public');
            $imgPath = Storage::url($file);
        } else {
            $imgPath = '';
        }
        
        $review->user_id = $userId;
        $review->shop_id = $shopId;
        $review->score = $score;
        $review->comment = $comment;
        $review->img_path = $imgPath;
        $review->save();

        $review = Review::where('user_id','=',$userId)
            ->where('shop_id','=',$shopId)
            ->get();

        return view('user.thanks',['review'=>$review]);
    }

    public function reviewAll(Request $request){
        $shopId = $request->shopId;
        $shop = Shop::find($shopId);
        $reviews = Review::with(['user'])
            ->where('shop_id','=',$shopId)
            ->get();

        return view('user.reviewAll',['reviews'=>$reviews,'shop'=>$shop]);
    }

    
}
