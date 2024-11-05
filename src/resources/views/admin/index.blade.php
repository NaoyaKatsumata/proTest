@extends('header-index')

@section('content')
<div class="flex flex-wrap w-[90%] mx-auto">
    @foreach($shops as $shop)
    <div class="flex-column break-words w-[49%] h-[300px] mx-[0.5%] mb-4 bg-white rounded-[10px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)] md:w-[24%] h-[300px] mx-[0.5%]">
        <img class="object-cover w-full h-1/2 rounded-t-[10px] text-center text-4xl" src="{{ asset('storage/'.$shop->img_path)}}" alt="No Image">

        <div class="mx-4">
        <div class="mt-4">{{$shop->shop_name}}</div>
            <div class="flex">
                <div class="text-xs">#{{$shop->area->area_name}}</div>
                <div class="text-xs mx-[5px]">#{{$shop->category->category_name}}</div>
            </div>
            <div class="flex justify-between w-full mx-auto h-[50px] my-4">
                <form class="flex content-center " action="/detail" method="get">
                    <input type="hidden" name="shopId" value="{{$shop->id}}">
                    <input type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-[5px]" value="詳しくみる"/>
                </form>
                <form class="w-[50px]" action="/" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="shopId" value="{{$shop->id}}">
                    <button type="submit" style="border: none; background: none;">
                        @php
                            $favoriteFlg = false;
                            foreach($favorites as $favorite){
                                if($favorite->shop_id === $shop->id){
                                    $favoriteFlg=true;
                                    break;
                                }
                            }
                        @endphp
                        @if($favoriteFlg)
                            <img class="object-cover w-full h-full bg-red-500 text-center text-4xl" src="{{ asset('img/heart.png')}}" alt="No Image">
                        @else
                            <img class="object-cover w-full h-full bg-white text-center text-4xl" src="{{ asset('img/heart.png')}}" alt="No Image">
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection