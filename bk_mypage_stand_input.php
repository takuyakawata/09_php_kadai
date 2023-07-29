<?php
session_start();
include('_functions.php');
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>本棚への登録</title>
</head>

<body>
  <!-- <form action="bk_mypage_stand_create.php" method="POST">
    <fieldset>
      <legend>本棚への登録</legend>
      <a href="bk_mypage_stand_read.php">本棚の一覧画面</a>
      <a href="login/logout.php">logout</a>

１バーコード
２検索から
３手入力
    <!-- <div>
        画像: <input type="file" name="book_cover">
    </div> -->
    <!-- <div>
        本のタイトル:<input type="text" name="title">
    </div>
    <div>
        著者:<input type="text" name="author">
    </div>
    <div>
        内容:<input type="text" name="content">
    </div>
    <div>
        出版社:<input type="text" name="company">
    </div>
    <div>
        発売日:<input type="date" name="released_day">
    </div>
    <div>
        ISBN:<input type="text" name="isbn">
    </div>

    <div>
        <button>submit</button>
    </div>
    </fieldset> -->
  <!-- </form> --> 

<form action="bk_mypage_stand_create.php" method="POST" class="max-w-md mx-auto bg-white shadow-md rounded px-8 py-6">

    <legend class="text-xl font-bold mb-4">本棚への登録</legend>
    <a href="bk_mypage_stand_read.php" class="text-blue-500 hover:underline mb-2 block">本棚</a>
    <a href="login/logout.php" class="text-blue-500 hover:underline mb-4 block">logout</a>

    <div class="mb-4 flex items-center">
      <label for="barcode" class="block text-gray-700 font-bold mr-2">１バーコード</label>
      <input type="radio" name="search_type" id="barcode" value="barcode">
    </div>
    <div class="mb-4 flex items-center">
      <label for="search" class="block text-gray-700 font-bold mr-2">２検索から</label>
      <input type="radio" name="search_type" id="search" value="search">
    </div>
    <div class="mb-4 flex items-center">
      <label for="manual" class="block text-gray-700 font-bold mr-2">３手入力</label>
      <input type="radio" name="search_type" id="manual" value="manual">
    </div>

    <!-- 画像アップロードはコメントアウトしています -->
    <!-- <div class="mb-4">
      <label for="book_cover" class="block text-gray-700 font-bold mb-2">画像:</label>
      <input type="file" name="book_cover" id="book_cover">
    </div> -->

    <div class="mb-4">
      <label for="title" class="block text-gray-700 font-bold mb-2">本のタイトル:</label>
      <input type="text" name="title" id="title" class="border rounded px-3 py-2 w-full">
    </div>
    <div class="mb-4">
      <label for="author" class="block text-gray-700 font-bold mb-2">著者:</label>
      <input type="text" name="author" id="author" class="border rounded px-3 py-2 w-full">
    </div>
    <div class="mb-4">
      <label for="content" class="block text-gray-700 font-bold mb-2">内容:</label>
      <input type="text" name="content" id="content" class="border rounded px-3 py-2 w-full">
    </div>
    <div class="mb-4">
      <label for="company" class="block text-gray-700 font-bold mb-2">出版社:</label>
      <input type="text" name="company" id="company" class="border rounded px-3 py-2 w-full">
    </div>
    <div class="mb-4">
      <label for="released_day" class="block text-gray-700 font-bold mb-2">発売日:</label>
      <input type="date" name="released_day" id="released_day" class="border rounded px-3 py-2 w-full">
    </div>
    <div class="mb-4">
      <label for="isbn" class="block text-gray-700 font-bold mb-2">ISBN:</label>
      <input type="text" name="isbn" id="isbn" class="border rounded px-3 py-2 w-full">
    </div>

    <div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Submit
      </button>
    </div>

</form>
</body>

</html>