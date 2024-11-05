<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="bg-gray-100">
    @php
        $userId = Auth::guard('owners')->check() ? Auth::guard('owners')->user()->id : '';
    @endphp
    <div class="mx-[5%] mt-8 ">
        <div class="flex items-center mr-8">
            <div id="loginMenu" class="relative w-[40px] h-[40px]  bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                <div class="w-[70%] mx-auto">
                    <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                    <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                    <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                </div>
            </div>
            <h1 class="pl-8 py-2 font-bold text-4xl text-blue-600">Rose</h1>
        </div>
        <main class="mx-auto">
            <p class="ml-[50%] my-4 text-3xl font-bold">{{Auth::guard('owners')->user()->name}}さん</p>
            <div class="flex my-8">
                <div class="w-[40%] mr-16">
                    <p class="my-4 font-bold text-xl">予約状況</p>
                    @php
                        $count = 1;
                        $nowDate = new DateTime();
                        $nowDate->format('Y-m-d');
                    @endphp
                    @foreach($reservations as $reservation)
                    <div class="w-[90%] mr-[10%] bg-blue-500 rounded-[10px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                        @php
                            $timestamp = explode(" ", $reservation->reservation_date);
                            $date = $timestamp[0];
                            $time = $timestamp[1];
                        @endphp
                        <div class="mx-8">
                            <div class="flex">
                                <i class="content-center mx-4 fa-regular fa-clock fa-lg text-white"></i>
                                <p class="my-4 text-white">予約{{$count}}</p>
                                <form class="mt-4 ml-auto mr-4" action="/mypage" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="reservationId" value="{{$reservation->id}}">
                                    <input type="hidden" name="userId" value="{{Auth::guard('owners')->user()->id}}">
                                    <button type="submit">
                                        <i class="fa-solid fa-trash fa-lg text-white"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="mx-4 mb-4">
                                <table class="w-[90%] mx-auto text-white">
                                    <tr>
                                        <td class="w-[20%] pb-4">Shop</td>
                                        <td class="w-[80%] pb-4 px-4">{{$reservation->shop->shop_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-[20%] pb-4">Date</td>
                                        <td class="w-[80%] pb-4 px-4">{{$date}}</td>
                                    </tr>
                                    <tr>
                                    <td class="w-[20%] pb-4">Time</td>
                                        <td class="w-[80%] pb-4 px-4">{{$time}}</td>
                                    </tr>
                                    <tr>
                                    <td class="w-[20%] pb-4">Number</td>
                                        <td class="w-[80%] pb-4 px-4">{{$reservation->reservation_guest_count}}人</td>
                                    </tr>
                                </table>
                                @php
                                    $reservationDate = new DateTime($reservation->reservation_date);
                                    $reservationDate->format('Y-m-d');
                                @endphp
                                @if($reservationDate>$nowDate)
                                    <form class="flex justify-end w-full" action="/edit" method="post">
                                        @csrf
                                        <input type="hidden" name="userId" value="{{Auth::guard('owners')->user()->id}}">
                                        <input type="hidden" name="shopId" value="{{$reservation->id}}">
                                        <input type="hidden" name="date" value="{{$reservation->reservation_date}}">
                                        <input type="hidden" name="time" value="{{$reservation->reservation_time}}">
                                        <input type="hidden" name="number" value="{{$reservation->reservation_guest_count}}">
                                        <input type="submit" class="w-[100px] content-center mb-2 px-4 text-white bg-blue-400 rounded-[5px]" value="編集">
                                    </form>
                                @elseif($reservationDate<$nowDate)
                                    <form class="flex justify-end w-full" action="/review" method="post">
                                        @csrf
                                        <input type="hidden" name="userId" value="{{Auth::guard('owners')->user()->id}}">
                                        <input type="hidden" name="shopId" value="{{$reservation->id}}">
                                        <input type="submit" class="w-[100px] content-center mb-2 px-4 text-white bg-blue-400 rounded-[5px]" value="評価">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                    $count += 1
                    @endphp
                    @endforeach
                </div>
                <div class="w-[60%]">
                    <p class="my-4 font-bold text-xl">お気に入り店舗</p>
                    <div class="flex flex-wrap">
                        @foreach($favorites as $favorite)
                            <div class="flex-column break-words w-[45%] h-[300px] mr-[5%] mb-4 bg-white rounded-[10px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                                <img class="object-cover w-full h-1/2 rounded-t-[10px] text-center text-4xl" src="{{ asset('storage/'.$favorite->shop->img_path)}}" alt="No Image">

                                <div class="mx-4">
                                <div class="mt-4">{{$favorite->shop->shop_name}}</div>
                                    <div class="flex">
                                        <div class="text-xs">#{{$favorite->shop->area->area_name}}</div>
                                        <div class="text-xs mx-[5px]">#{{$favorite->shop->category->category_name}}</div>
                                    </div>
                                    <div class="flex justify-between w-full mx-auto h-[50px] my-4">
                                        <form class="flex content-center " action="/detail" method="get">
                                            <input type="hidden" name="shopId" value="{{$favorite->shop->id}}">
                                            <input type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-[5px]" value="詳しくみる"/>
                                        </form>
                                        <form class="w-[50px]" action="/mypage" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="shopId" value="{{$favorite->shop->id}}">
                                            <button type="submit" style="border: none; background: none;">
                                            <img class="object-cover w-full h-full bg-red-500 text-center text-4xl" src="{{ asset('img/heart.png')}}" alt="No Image">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
    

    <!-- モーダルウィンドウ -->
    <div id="login" class="fixed inset-0 bg-gray-600 bg-white hidden justify-center items-center">
    <div id="closeLoginMenu" class="relative mx-[5%] w-[40px] h-[40px] mt-10 bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="w-[70%] mx-auto">
                <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
            </div>
        </div>
        <div class="flex justify-center w-[80%] mx-auto mt-8 bg-white p-8 rounded-lg">
            <ul>
                <li class="mb-2 text-2xl text-blue-500"><a href="/">Home</a></li>
                <li class="mb-2"><form class="text-2xl text-blue-500" method="POST" action="{{ route('owner.logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('owner.logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form></li>
                <li class="mb-2 text-2xl text-blue-500">
                    <form class="text-2xl text-blue-500" method="get" action="/mypage">
                        <input type="submit" value="My page">
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <script>
        // モーダルを表示する
        const loginMenu = document.getElementById('loginMenu');
        const login = document.getElementById('login');
        const closeLoginMenu = document.getElementById('closeLoginMenu');

        if (loginMenu) {
            loginMenu.addEventListener('click', () => {
                login.classList.remove('hidden');
            });
        }

        closeLoginMenu.addEventListener('click', () => {
            login.classList.add('hidden');
        });
    </script>
</body>
</html>