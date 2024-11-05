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
        $userId = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : '';
    @endphp
    
    <div class="flex mx-[5%] mt-8 justify-between">
        <div class="flex mr-8 items-center">
            @auth('admin')
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
    </div>

    <div class="my-[5%] mx-[5%]">
        <p class="text-xl">インポートするファイルを選択してください</p>
        <form action="/admin/import" method="POST" class="mt-8" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required >
            <button type="submit" class="w-[200px] my-4 py-2 px-4 text-center text-white bg-blue-400 rounded-[5px]">インポート</button>
        </form>
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
            <li class="mb-2 text-2xl text-blue-500"><a href="/admin">Home</a></li>
            <li class="mb-2"><form class="text-2xl text-blue-500" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <x-dropdown-link :href="route('admin.logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form></li>
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