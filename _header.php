<?php

$n = mt_rand(1, 3);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>MEET BOOKS</title>

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


</head>
<body>
    <header>
    <div class="top_text">自分の欲しい本を探して、読もうね！！</div>

<style>
.top_text {
    background-color: rgb(217, 145, 208);
    color: bisque;
    font-size: 28px;
}
</style>

    </header>