<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @php
        $userId = Auth::guard('owners')->check() ? Auth::guard('owners')->user()->id : '';
    @endphp
    <div class="flex mx-[5%] mt-8 ">
        <div class="w-1/2">
            <div class="flex mr-8 items-center">
                @auth('owners')
                <div id="loginMenu" class="relative w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                    <div class="w-[70%] mx-auto">
                        <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                        <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                        <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                    </div>
                </div>
                @else
                <div id="guestMenu" class="relative w-[40px] h-[40px] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                    <div class="w-[70%] mx-auto">
                        <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                        <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                        <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                    </div>
                </div>
                @endauth
                <h1 class="pl-8 py-2 font-bold text-4xl text-blue-600">Rose</h1>
            </div>

            <div class="mr-[5%]">
                <div class="flex items-center mt-8">
                    <a href="/" class="inline-block w-[30px] h-[30px] text-center bg-white rounded-[5px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]"><</a>
                    <p class="ml-4 text-2xl font-bold">{{$shop->shop_name}}</p>
                </div>
                @if($reviews !== null && $reviews->count() !== 0)
                <img class="my-8 h-48 w-full object-cover" src="{{ asset('storage/'.$shop->img_path)}}" alt="No Image">
                @else
                <img class="my-8" src="{{ asset('storage/'.$shop->img_path)}}" alt="No Image">
                @endif

                <div class="flex mb-8">
                    <p>#{{$shop->area->area_name}}</p>
                    <p>#{{$shop->category->category_name}}</p>
                </div>

                <p>{{$shop->detail}}</p>

                @if($reviews !== null && $reviews->count() !== 0)
                    <form class="flex content-center mt-8" action="/review-all" method="get">
                        <input type="hidden" name="shopId" value="{{$shop->id}}">
                        <input type="submit" class="w-full py-2 text-white bg-blue-400" value="すべての口コミ情報"/>
                    </form>
                @endif

                @if($reviews === null || $reviews->count() === 0)
                    <form class="flex content-center mt-8" action="/review" method="get">
                        <input type="hidden" name="shopId" value="{{$shop->id}}">
                        <input type="submit" class="border-b border-black" value="口コミを投稿する"/>
                    </form>
                @else
                <div class="mt-4 border-y-2 border-gray-300">
                    <div class="flex justify-end my-4">
                        <form class="flex content-center" action="/review-edit" method="get">
                            <input type="hidden" name="shopId" value="{{$shop->id}}">
                            <input type="submit" class="border-b border-black" value="口コミを編集"/>
                        </form>
                        <form class="flex content-center ml-4" action="/review-edit" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="shopId" value="{{$shop->id}}">
                            <input type="submit" class="border-b border-black" value="口コミを削除"/>
                        </form>
                    </div>
                    <div class="flex mb-4">
                        @if($reviews->score ===1)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                        @elseif($reviews->score ===2)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                        @elseif($reviews->score ===3)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                        @elseif($reviews->score ===4)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                        @elseif($reviews->score ===5)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[30px] mr-2">
                        @else
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[30px] mr-2">
                        @endif
                    </div>
                    <p class="break-words whitespace-normal">{{$reviews->comment}}</p>
                </div>
                @endif
            </div>

        </div>
        <div class="w-1/2 mx-[5%] bg-blue-600 rounded-[5px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                <form class="flex flex-col w-full mx-auto h-full" action="/done" method="post">
                    @csrf
                    <p class="text-white mx-[5%] my-8 font-bold text-2xl">予約</p>
                    <input type="hidden" name="shopId" value="{{$shop->id}}">
                    <input type="hidden" name="userId" value="{{$userId}}">
                    <input type="date" class="mx-[5%] w-[40%] my-2 rounded-[5px] w-[90%] md:w-[50%]" name="date" id="date" value="{{date('Y-m-d')}}">
                    <select class="mx-[5%] my-2 rounded-[5px]" name="time" id="time">
                        <option>11:00</option>
                        <option>12:00</option>
                        <option>13:00</option>
                        <option>14:00</option>
                        <option>15:00</option>
                        <option>16:00</option>
                        <option>17:00</option>
                        <option>18:00</option>
                        <option>19:00</option>
                        <option>20:00</option>
                        <option>21:00</option>
                        <option>22:00</option>
                    </select>
                    <select class="mx-[5%] my-2 rounded-[5px]" name="num" id="number">
                        <option>1人</option>
                        <option>2人</option>
                        <option>3人</option>
                        <option>4人</option>
                        <option>5人</option>
                        <option>6人</option>
                        <option>7人</option>
                        <option>8人</option>
                        <option>9人</option>
                        <option>10人</option>
                    </select>
                <div class="flex content-center w-[90%] mx-[5%] mx-auto my-2 bg-blue-500 rounded-[5px]">
                    <table class="w-[90%] mx-auto">
                        <tr>
                            <td class="w-[30%] py-2 text-left text-white">Shop</td>
                            <td class="w-[70%] py-2 px-4 text-left text-white" id="shopName">{{$shop->shop_name}}</td>
                        </tr>
                        <tr>
                            <td class="w-[30%] py-2 text-left text-white">Date</td>
                            <td class="w-[70%] py-2 px-4 text-left text-white" id="selectedDate">{{date('Y-m-d')}}</td>
                        </tr>
                        <tr>
                            <td class="w-[30%] py-2 text-left text-white">Time</td>
                            <td class="w-[70%] py-2 px-4 text-left text-white" id="selectedTime">11:00</td>
                        </tr>
                        <tr>
                            <td class="w-[30%] py-2 text-left text-white">Number</td>
                            <td class="w-[70%] py-2 px-4 text-left text-white" id="selectedNumber">1人</td>
                        </tr>
                    </table>
                </div>

                <div class="my-4">
                    @foreach($errors->all() as $error)
                    <li class="w-[90%] mx-[5%] mx-auto font-bold text-red-500">{{$error}}</li>
                    @endforeach
                </div>

                <div class="w-full mb-0 mt-auto">
                    <input type="submit" class="w-full py-4 text-center text-white bg-blue-700" name="" value="予約する">
                </div>
            </form>
        </div>
    </div>

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

    <!-- モーダルウィンドウ -->
    <div id="guest" class="fixed inset-0 bg-gray-600 bg-white hidden justify-center items-center">
        <div id="closeGuestMenu" class="relative mx-[5%] w-[40px] h-[40px] mt-10 bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
            <div class="w-[70%] mx-auto">
                <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
            </div>
        </div>
        <div class="flex justify-center w-[80%] mx-auto mt-8 bg-white p-8 rounded-lg">
            <ul>
                <li class="mb-2 text-2xl text-blue-500"><a href="/">Home</a></li>
                <li class="mb-2 text-2xl text-blue-500"><a href="{{ route('owner.login') }}">Log in</a></li>
                <li class="mb-2 text-2xl text-blue-500"><a href="{{ route('owner.register') }}">Register</a></li>
            </ul>
        </div>
    </div>

    <script>
        // モーダルを表示する
        const guestMenu = document.getElementById('guestMenu');
        const loginMenu = document.getElementById('loginMenu');
        const login = document.getElementById('login');
        const guest = document.getElementById('guest');
        const closeLoginMenu = document.getElementById('closeLoginMenu');
        const closeGuestMenu = document.getElementById('closeGuestMenu');

        if (guestMenu) {
            guestMenu.addEventListener('click', () => {
                guest.classList.remove('hidden');
            });
        }
        if (loginMenu) {
            loginMenu.addEventListener('click', () => {
                login.classList.remove('hidden');
            });
        }

        closeLoginMenu.addEventListener('click', () => {
            login.classList.add('hidden');
        });
        closeGuestMenu.addEventListener('click', () => {
            guest.classList.add('hidden');
        });
    </script>

    <script>
        const selectDate = document.getElementById('date');
        const selectTime = document.getElementById('time');
        const selectNumber = document.getElementById('number');
        const selectedDate = document.getElementById('selectedDate');
        const selectedTime = document.getElementById('selectedTime');
        const selectedNumber = document.getElementById('selectedNumber');

        selectDate.addEventListener('change',function(){
            console.log('change date');
            selectedDate.innerText = selectDate.value
        });
        selectTime.addEventListener('change',function(){
            console.log('change time');
            const num = selectTime.selectedIndex;
            selectedTime.innerText = selectTime.options[num].innerText;
        });
        selectNumber.addEventListener('change',function(){
            console.log('change number');
            const num = selectNumber.selectedIndex;
            selectedNumber.innerText = selectNumber.options[num].innerText;
        });
    </script>
</body>
</html>