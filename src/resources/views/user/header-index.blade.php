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
        $userId = Auth::guard('users')->check() ? Auth::guard('users')->user()->id : '';
    @endphp
    
    <div class="flex mx-[5%] mt-8 justify-between">
        <div class="flex mr-8 items-center">
            @auth('users')
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

        <form id="price-sort" action="/" method="post" class="flex gap-0 ml-auto mr-0">
            @csrf
            <input type="hidden" name="userId" value="{{ $userId }}">
            <input type="hidden" name="sort" id="sort-value" >
            <div class="relative flex item-center custom-select mr-8">
                <div class="custom-select-trigger w-[200px] content-center bg-white border border-gray-400 p-2 cursor-pointer">@php
                                if(empty($selectedSort)){
                                    echo "選択してください";
                                }elseif($selectedSort==='random'){
                                    echo "ランダム";
                                }elseif($selectedSort==='desc'){
                                    echo "評価が高い順";
                                }elseif($selectedSort==='asc'){
                                    echo "評価が低い順";
                                }
                            @endphp</div>
                <div class="custom-options absolute hidden bg-white border border-gray-300 rounded-lg mt-14 w-full shadow-lg">
                    <span class="custom-option block px-4 py-2 hover:bg-blue-400 hover:text-white cursor-pointer" data-value="random">ランダム</span>
                    <span class="custom-option block px-4 py-2 hover:bg-blue-400 hover:text-white cursor-pointer" data-value="desc">評価が高い順</span>
                    <span class="custom-option block px-4 py-2 hover:bg-blue-400 hover:text-white cursor-pointer" data-value="asc">評価が低い順</span>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg id="custom-arrow" class="w-8 h-8 text-red-500 transition-transform duration-200" viewBox="0 0 24 24" fill="#A0A0A0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5H7z"/>
                    </svg>
                </div>
            </div>
            <input type="search" class="w-[400px] border-gray-400 focus:ring-0" name="shopName" size="20" value="{{ $searchName ?? '' }}" placeholder="Search...">
            <select class="w-[200px] border border-gray-400 focus:ring-0" name="area" onchange="this.form.submit()">
                <option value="All area" @if($selectedArea == 'All area') selected @endif>All area</option>
                @foreach($areas as $area)
                    <option value="{{ $area->area_name }}" @if($selectedArea == $area->area_name) selected @endif>
                        {{ $area->area_name }}
                    </option>
                @endforeach
            </select>

            <select class="w-[200px] border border-gray-400 focus:ring-0" name="category" onchange="this.form.submit()">
                <option value="All category" @if($selectedCategory == 'All category') selected @endif>All category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->category_name }}" @if($selectedCategory == $category->category_name) selected @endif>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="my-[5%] mx-[5%]">
        @yield('content')
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
                <li class="mb-2"><form class="text-2xl text-blue-500" method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('user.logout')"
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
                <li class="mb-2 text-2xl text-blue-500"><a href="{{ route('user.login') }}">Log in</a></li>
                <li class="mb-2 text-2xl text-blue-500"><a href="{{ route('user.register') }}">Register</a></li>
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

    
    <!-- 価格で並び替えのselectボックスのカスタム関連 -->
    <script>
        const select = document.getElementById('custom-select');
        const customSelectTrigger = document.querySelector('.custom-select-trigger');
        const arrowIcon = document.getElementById('custom-arrow');
        const customOption = document.querySelector('.custom-options');
        const options = document.querySelectorAll('.custom-option');
        const sortValue = document.getElementById('sort-value');
        const priceForm = document.getElementById('price-sort');

        customSelectTrigger.addEventListener('click', function() {
            customOption.classList.toggle('hidden');
            arrowIcon.classList.toggle('rotate-180');
        });

        options.forEach(option => {
            option.addEventListener('click', function() {
                const selectedValue = this.getAttribute('data-value');
                const selectedText = this.textContent;
                customSelectTrigger.textContent = selectedText;
                customOption.classList.add('hidden');
                customSelectTrigger.classList.remove('text-gray-400');
                customSelectTrigger.classList.add('text-black');
                arrowIcon.classList.toggle('rotate-180');
                
                let url = new URL(window.location.href);
                url.searchParams.set('sort', selectedValue);
                window.location.href = url.toString();
                sortValue.value = selectedValue;
                priceForm.submit();
            });
        });
    </script>
</body>
</html>