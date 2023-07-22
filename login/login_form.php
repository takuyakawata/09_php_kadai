
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログインフォーム</title>

<link rel="stylesheet" href="css/bk_search.css">

<!-- firebase -->
    <script src="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.js"></script>

<link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.css" />
<!-- map -->
    <script src="https://cdn.jsdelivr.net/gh/yamazakidaisuke/BmapQuery/js/BmapQuery.js"></script>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- axios -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- googleBooksAPI -->
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>

<!-- bingMap -->
<script
    src="https://www.bing.com/api/maps/mapcontrol?mkt=ja-jp&key=AqcwE4abAtRFTiK8xl_Hcl35LxP0D8YT8NptLKATGrPItDqV-1yxYGNN8nXN-Tis"></script>

<!-- tailwindCSS -->
<script src="https://cdn.tailwindcss.com"></script>

</head>

<html>
<body>
<!-- ログインフォーム -->
<form class="space-y-6" action="login.php" method="POST">

<section class="w-full px-8 py-16 bg-gray-100 xl:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col items-center md:flex-row">

            <div class="w-full space-y-5 md:w-3/5 md:pr-16">
                <p class="font-medium text-blue-500 uppercase" data-primary="blue-500">Building Businesses</p>
                <h2 class="text-2xl font-extrabold leading-none text-black sm:text-3xl md:text-5xl">
                    あなたの欲しいものに出会おう！！
                </h2>
                <p class="text-xl text-gray-600 md:pr-16">最高の出会いがここにあるはず、、、</p>
            </div>

            <div class="w-full mt-16 md:mt-0 md:w-2/5">
                <div class="relative z-10 h-auto p-8 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7" data-rounded="rounded-lg" data-rounded-max="rounded-full">
                    <h3 class="mb-6 text-2xl font-medium text-center">入力してログイン</h3>
                    
                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="メールアドレス">

                    <input type="password" name="password" id="password" class="block w-full px-4 py-3 mb-4 border border-2 border-transparent border-gray-200 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" data-rounded="rounded-lg" data-primary="blue-500" placeholder="パスワード">

                    <div class="block">

                        <button class="w-full px-3 py-4 font-medium text-white bg-blue-600 rounded-lg" data-primary="blue-600" data-rounded="rounded-lg">ログイン</button>
                    </div>

                    <p class="w-full mt-4 text-sm text-center text-gray-500">
                        アカウントを持っていない？
                        <a href="signup.php" class="text-blue-500 underline">
                        Sign up はここ！</a></p>
                </div>
            </div>

        </div>
    </div>
</section>
</form>
<!-- -------- -->
</body>
</html>