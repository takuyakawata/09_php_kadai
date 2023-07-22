<?php

//ログインしているとき
if (isset($_SESSION['id'])) {
    $msg = 'こんにちは' . htmlspecialchars($_SESSION['username'], \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="login/logout.php">ログアウト</a>';
} else {
    //ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login/login.php">ログイン</a>';
}
?>

<div class="username">
    <h1><?php echo $msg; ?></h1>
    <p><?php echo $link; ?></p>
</div>


