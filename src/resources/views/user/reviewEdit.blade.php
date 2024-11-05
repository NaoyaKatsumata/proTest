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
        <main class="flex">
            <div class="w-full">
                <div class="flex">
                    <div class="w-[40%] mt-32 border-r-2 border-gray-300">
                        <div class="w-1/2 mx-auto whitespace-normal">
                            <p class="text-center text-4xl">今回のご利用はいかがでしたか？</p>
                            <div class="flex-column break-words h-[300px] my-16 bg-white rounded-[10px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
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
                        </div>
                    </div>
                    <form id="reviewValue" class="w-[60%]" action="/review" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <p class="my-4 ml-16 text-2xl">体験を評価してください</p>
                        <div class="flex ml-16">
                            @if($review->score ===1)
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star1">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star2">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star3">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star4">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star5">
                            @elseif($review->score ===2)
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star1">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star2">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star3">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star4">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star5">
                            @elseif($review->score ===3)
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star1">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star2">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star13">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star4">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star5">
                            @elseif($review->score ===4)
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star1">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star2">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star3">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star4">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star5">
                            @elseif($review->score ===5)
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star1">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star2">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star3">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star4">
                                <img src="{{ asset('img/star_blue.svg')}}" class="w-[40px] mr-2" id="star5">
                            @else
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star1">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star2">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star3">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star4">
                                <img src="{{ asset('img/star_gray.svg')}}" class="w-[40px] mr-2" id="star5">
                            @endif


                        </div>
                        @if ($errors->has('score'))
                            <div class="ml-16 text-red-500">{{ $errors->first('score') }}</div>
                        @endif
                        <input type="hidden" name="shopId" value="{{$shop->id}}">
                        <input type="hidden" id="review" name="score" value="{{$review->score}}">
                        <div class="mx-[10%] mt-8">
                            <p class="text-xl">口コミを投稿</p>
                            <textarea id="myTextarea" cols="100" rows="5" maxlength="400" name="comment" class="w-full mt-4 bg-gray-100 border border-gray-300 resize-none" placeholder="商品の説明を入力" oninput="updateCount()">{{$review->comment}}</textarea>
                            <p id="charCount" class="text-right">文字数: 0/400 (最大文字数)</p>
                            <p class="text-xl">画像の追加</p>
                            <div id="dropArea" class="mt-4 p-16 border-2 border-dashed border-gray-300 text-center bg-white rounded-lg cursor-pointer transition hover:bg-gray-50">
                                @if(empty($review->img_path))
                                    <p id="dropText1" class="text-gray-500">クリックして写真を追加</p>
                                    <p id="dropText2" class="text-gray-500">またはドロップアンドドロップ</p>
                                    <img id="previewImage" class="hidden" alt="Image Preview">
                                @else
                                    <p id="dropText1" class="text-gray-500"></p>
                                    <p id="dropText2" class="text-gray-500"></p>
                                    <img id="previewImage" src="{{ asset($review->img_path)}}" class="" alt="Image Preview">
                                @endif
                            </div>
                            @if ($errors->has('image'))
                                <div class="text-red-500">{{ $errors->first('image') }}</div>
                            @endif
                            <input type="file" id="fileInput" class="hidden" name="image">
                        </div>
                    </form>
                </div>
                <button type="submit" form="reviewValue" class="w-1/2 mx-[25%] mt-16 py-4 rounded-full bg-white">口コミを投稿</button>
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