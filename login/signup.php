<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>サインアップ</title>

<?php
include('../_head.php');

?>

<!-- -------------------- -->
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <!-- <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"> -->
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">新規会員登録</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

    <form class="space-y-6" action="register.php" method="POST">
      <div>
        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">名前</label>
        <div class="mt-2">
          <input id="text" name="username" type="text" autocomplete="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">メールアドレス</label>
        <div class="mt-2">
          <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">パスワード</label>
          <div class="text-sm">
           
          </div>
        </div>

        <div class="mt-2">
          <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
      <div>

        <button class="w-full px-3 py-4 font-medium text-white bg-blue-600 rounded-lg" data-primary="blue-600" data-rounded="rounded-lg">新規会員登録</button>

      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      登録されていますか？
      <a href="login_form.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">会員の方はこちらから</a>
    </p>
  </div>
</div>


<!-- ----------------------------------- -->

<!-- <h1>新規会員登録</h1>
<form action="register.php" method="post">

<div>
    <label>
        名前：
        <input type="text" name="name" required>
    </label>
</div>
<div>
    <label>
        メールアドレス：
        <input type="text" name="mail" required>
    </label>
</div>
<div>
    <label>
        パスワード：
        <input type="password" name="pass" required>
    </label>
</div>
<input type="submit" value="新規登録">
</form>
<p>すでに登録済みの方は<a href="login_form.php">こちら</a></p> -->