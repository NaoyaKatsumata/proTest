<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientDataImport;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use App\Models\Review;

class AdminController extends Controller
{
    public function index(){
        return view('admin.mypage');
    }

    public function showImport(){
        return view('admin.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new ClientDataImport, $request->file('file'));

        return view('admin.mypage');
    }

    public function shops(){
        $user = Auth::guard('admin')->user();
        if($user){
            $userId = $user->id;
        }else{
            $userId = '';
        }
        $shops = Shop::all();
        $areas = Area::all();
        $categories = Category::all();

        return view('admin.index',['userId'=>$userId,
                             'shops'=>$shops,
                             'areas'=>$areas,
                             'categories'=>$categories,
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

        $shops = Shop::with(['area', 'category','scores'])
            ->when($sort === 'desc' or $sort === 'asc', function ($query) {
                return $query->select('shops.*')
                    ->selectRaw('AVG(reviews.score) as average_score') // スコアの平均を取得
                    ->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id') // JOINでスコアを関連付け
                    ->groupBy('shops.id');
            })
            ->when($sort === 'random', function ($query) use ($sort) {
                return $query->inRandomOrder();
            })
            ->when($sort === 'asc', function ($query) use ($sort) {
                return $query->orderByRaw('average_score IS NULL, average_score '.$sort);
            })
            ->when($sort === 'desc', function ($query) use ($sort) {
                return $query->orderByRaw('average_score IS NULL, average_score '.$sort);
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

            return view('admin.index',['userId'=>$userId,
                                 'shops'=>$shops,
                                 'areas'=>$areas,
                                 'categories'=>$categories,
                                 'selectedSort'=>$sort,
                                 'searchName'=>$searchName,
                                 'selectedArea'=>$selectedArea,
                                 'selectedCategory'=>$selectedCategory]);

    }

    public function reviewAll(Request $request){
        $shopId = $request->shopId;
        $shop = Shop::find($shopId);
        $reviews = Review::with(['user'])
            ->where('shop_id','=',$shopId)
            ->get();

        return view('admin.reviewAll',['reviews'=>$reviews,'shop'=>$shop]);
    }

    public function deleteAdmin(Request $request){
        $reviewId = $request->reviewId;
        $shopId = $request->shopId;

        Review::where('id','=',$reviewId)
            ->delete();
        
        return redirect('admin/review-all?shopId='.$shopId);
    }
}
