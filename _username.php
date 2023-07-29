<?php
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['email'];

// ユーザーネームとメールアドレスを表示するためのパーツとして_username.phpを準備しておく。これだけで動かすとエラーがでます。理由は、セッションIDなどを使うためのsession_startがここに記述できていないため。_functionとセットで使うので、、、

//ログインしているとき
if (isset($_SESSION['user_id'])) {
    $msg = htmlspecialchars($_SESSION['username'], \ENT_QUOTES, 'UTF-8') . 'さん';
     $email =  htmlspecialchars($user_email, \ENT_QUOTES, 'UTF-8') ;

    $link = '<a href="login/logout.php">ログアウト</a>';
} else {
    //ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login/login.php">ログイン</a>';
}
?>

<!-- <div class="username">
    <h1> echo $msg; ?></h1>
    <p> echo $link; ?></p>
</div> -->


