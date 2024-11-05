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
        $userId = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : '';
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
            test
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
                <li class="mb-2"><form class="text-2xl text-blue-500" method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('admin.logout')"
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