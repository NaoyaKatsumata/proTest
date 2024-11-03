<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user){
            $userId = $user->id;
        }else{
            $userId = '';
        }
        $shops = Shop::all();
        $areas = Area::all();
        $categories = Category::all();
        $favorites = Favorite::where('user_id','=',$userId)
            ->get();
        return view('index',['userId'=>$userId,
                             'shops'=>$shops,
                             'areas'=>$areas,
                             'categories'=>$categories,
                             'favorites'=>$favorites,
                             'selectedSort'=>'',
                             'searchName'=>'',
                             'selectedArea'=>'',
                             'selectedCategory'=>'']);
    }

    public function search(Request $request){
        $userId = $request->userId;
        $sort = $request->sort;
        $searchName = $request->shopName;
        $selectedArea = $request->area;
        $selectedCategory = $request->category;
        $areas = Area::all();
        $categories = Category::all();
        $favorites = Favorite::where('user_id','=',$userId)
                     ->get();
        $shops = Shop::with(['area', 'category'])
            ->when($sort === 'random', function ($query) use ($sort) {
                return $query->inRandomOrder();
            })
            ->when($sort === 'asc', function ($query) use ($sort) {
                return $query->orderBy('shop_name', $sort);
            })
            ->when($sort === 'desc', function ($query) use ($sort) {
                return $query->orderBy('shop_name', $sort);
            })
            ->when($searchName, function ($query) use ($searchName) {
                return $query->where('shop_name', 'like', '%' . $searchName . '%');
            })
            ->when($selectedArea !== 'All area', function ($query) use ($selectedArea) {
                return $query->whereHas('area', function ($q) use ($selectedArea) {
                    $q->where('area_name', $selectedArea);
                });
            })
            ->when($selectedCategory !== 'All category', function ($query) use ($selectedCategory) {
                return $query->whereHas('category', function ($q) use ($selectedCategory) {
                    $q->where('category_name', $selectedCategory);
                });
            })
            ->get();

            return view('index',['userId'=>$userId,
                                 'shops'=>$shops,
                                 'areas'=>$areas,
                                 'categories'=>$categories,
                                 'favorites'=>$favorites,
                                 'selectedSort'=>$sort,
                                 'searchName'=>$searchName,
                                 'selectedArea'=>$selectedArea,
                                 'selectedCategory'=>$selectedCategory]);

    }

    public function favorite(Request $request){
        $shopId = $request->shopId;
        $user = Auth::user();
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

        return redirect('/');
    }
}