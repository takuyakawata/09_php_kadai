<?php
session_start();

include('../_functions.php');
$pdo = connect_to_db();


$mail = $_POST['email'];
$pass = $_POST['pass'];



// username，password，deleted_atの3項目全ての条件満たすデータを抽出する．
$sql = "SELECT * FROM books_users WHERE email = :email AND pass=:pass";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email,PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass,PDO::PARAM_STR);
$stmt->execute();


try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


//指定したハッシュがパスワードにマッチしているかチェック
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href='login/login_form.php'>ログイン</a>";
  exit();
} else {
  $_SESSION = array();
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $user['is_admin'];
  $_SESSION['username'] = $user['username'];


  header("Location:bk_home2.php");
  exit();
}

?>

<!-- -------------------------------------- -->
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログインフォーム</title>

<link rel="stylesheet" href="css/bk_search.css">
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"><?php echo $msg; ?></h1>
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">ようこそ！</h2>
</div>

<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

  <div>
    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><?php echo $link; ?></button>
  </div>

</div>
