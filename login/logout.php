
<?php
session_start();
$_SESSION = array();//セッションの中身をすべて削除

if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
header('Location:login_form.php');
exit();
?>

<p>ログアウトしました。</p>
<a href="login.php">ログインへ</a>
