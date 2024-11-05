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
        <div class="flex mr-8">
            <div id="loginMenu" class="relative w-[40px] h-[40px] mt-[5%] bg-blue-600 rounded-[5px] fixed shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)]">
                <div class="w-[70%] mx-auto">
                    <div class="absolute top-[10px] w-[50%] h-[1px] bg-white mx-auto"></div>
                    <div class="absolute top-[20px] w-[70%] h-[1px] bg-white"></div>
                    <div class="absolute top-[30px] w-[20%] h-[1px] bg-white"></div>
                </div>
            </div>
            <h1 class="pl-8 py-2 font-bold text-4xl text-blue-600">Rose</h1>
        </div>
    </div>

    <div class="my-[5%] mx-[5%]">
        @yield('content')
    </div>
</body>
</html>