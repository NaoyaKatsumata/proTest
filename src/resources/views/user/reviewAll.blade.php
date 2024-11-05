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
        $userId = Auth::guard('users')->check() ? Auth::guard('users')->user()->id : '';
    @endphp
    <div class="mt-8">
        <div class="flex items-center ml-[5%] mr-8">
            <div id="loginMenu" class="relative w-[40px] h-[40px]  bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                <div class="w-[70%] mx-auto">
                    <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                    <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                    <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                </div>
            </div>
            <h1 class="pl-8 py-2 font-bold text-4xl text-blue-600">Rose</h1>
        </div>
        <main class="flex flex-col">
            <p class="mx-[5%] mt-8 text-2xl">コメント一覧</p>
            <p class="mx-[5%] mt-4 text-xl font-bold">店舗名：{{$shop->shop_name}}</p>
            @foreach($reviews as $review)
                <form action="review-all" method="post" class="w-[90%] mx-auto mt-8 py-4 px-4 border-2">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="reviewId" value="{{$review->id}}">
                    <input type="hidden" name="shopId" value="{{$shop->id}}">
                    <p class="break-words whitespace-normal">ユーザ名：{{$review->user->name}}</p>
                    <div class="flex">
                        <p>評価：</p>
                        @if($review->score ===1)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star1">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star3">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star4">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star5">
                        @elseif($review->score ===2)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star1">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star3">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star4">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star5">
                        @elseif($review->score ===3)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star1">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star13">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star4">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star5">
                        @elseif($review->score ===4)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star1">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star3">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star4">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star5">
                        @elseif($review->score ===5)
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star1">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star2">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star3">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star4">
                            <img src="{{ asset('img/star_blue.svg')}}" class="w-[20px] mr-2" id="star5">
                        @else
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star1">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star2">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star3">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star4">
                            <img src="{{ asset('img/star_gray.svg')}}" class="w-[20px] mr-2" id="star5">
                        @endif
                    </div>
                    <p class="break-words whitespace-normal">コメント：{{$review->comment}}</p>
                    <input type="submit" name="submit" class="w-[100px] bg-blue-500 text-white rounded-[5px] mt-4" value="削除">
                </form>
            @endforeach
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

    <script>
        function updateCount() {
            const textarea = document.getElementById('myTextarea');
            const charCount = document.getElementById('charCount');
            charCount.textContent = '文字数: ' + textarea.value.length + '/400 (最大文字数)';
        }
    </script>

    <script>
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('fileInput');
        const dropText1 = document.getElementById('dropText1');
        const dropText2 = document.getElementById('dropText2');

        // ドラッグオーバーとドロップのイベントを防ぐ
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('bg-blue-50');
            const files = e.dataTransfer.files;
            fileInput.files = files;
            const event = new Event('change', { bubbles: true });
            fileInput.dispatchEvent(event);
        });

        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            const files = e.target.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            if (files.length > 0) {
                dropText1.textContent = ``;
                dropText2.textContent = ``;
                const file = files[0];
                console.log(file);
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewImage = document.getElementById('previewImage');
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }
        };
    </script>

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
    <script>
        const star1 = document.getElementById('star1');
        const star2 = document.getElementById('star2');
        const star3 = document.getElementById('star3');
        const star4 = document.getElementById('star4');
        const star5 = document.getElementById('star5');
        let review = document.getElementById('review');

        star1.addEventListener('click',()=>{
            star1.src="../img/star_blue.svg";
            star2.src="../img/star_gray.svg";
            star3.src="../img/star_gray.svg";
            star4.src="../img/star_gray.svg";
            star5.src="../img/star_gray.svg";
            review.value = 1;
            console.log(review.value);
        });
        star2.addEventListener('click',()=>{
            star1.src="../img/star_blue.svg";
            star2.src="../img/star_blue.svg";
            star3.src="../img/star_gray.svg";
            star4.src="../img/star_gray.svg";
            star5.src="../img/star_gray.svg";
            review.value = 2;
            console.log(review.value);
        });
        star3.addEventListener('click',()=>{
            star1.src="../img/star_blue.svg";
            star2.src="../img/star_blue.svg";
            star3.src="../img/star_blue.svg";
            star4.src="../img/star_gray.svg";
            star5.src="../img/star_gray.svg";
            review.value = 3;
            console.log(review.value);
        });
        star4.addEventListener('click',()=>{
            star1.src="../img/star_blue.svg";
            star2.src="../img/star_blue.svg";
            star3.src="../img/star_blue.svg";
            star4.src="../img/star_blue.svg";
            star5.src="../img/star_gray.svg";
            review.value = 4;
            console.log(review.value);
        });
        star5.addEventListener('click',()=>{
            star1.src="../img/star_blue.svg";
            star2.src="../img/star_blue.svg";
            star3.src="../img/star_blue.svg";
            star4.src="../img/star_blue.svg";
            star5.src="../img/star_blue.svg";
            review.value = 5;
            console.log(review.value);
        });
    </script>
</body>
</html>