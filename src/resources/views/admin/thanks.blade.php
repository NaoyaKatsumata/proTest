<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/allshop.css') }}">
    <script src="{{ asset('js/pagereload.js') }}"></script>
</head>
<body id="body" class="bg-zinc-100 overflow-hidden w-[90%] mx-auto">
    <!-- アイコン&タイトル -->
    <header class="w-[90%] mx-auto mt-8 bg-zinc-100 ">
        <div class="flex items-center mr-8">
            <div id="loginMenu" class="relative w-[40px] h-[40px]  bg-blue-600 rounded-[5px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                <div class="w-[70%] mx-auto">
                    <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                    <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                    <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                </div>
            </div>
            <h1 class="pl-8 py-2 font-bold text-4xl text-blue-600">Rose</h1>
        </div>
    </header>
    <main class="my-16">
        <div class="flex flex-col justify-center w-[500px] mx-auto py-32 bg-white rounded-[5px] shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
            <p class="text-center text-xl">ご評価ありがとうございます</p>
            <a href="/" class="w-[100px] mx-auto my-8 text-center bg-blue-600 text-white rounded-[5px]">戻る</a>
        </div>
    </main>
</body>
</html>