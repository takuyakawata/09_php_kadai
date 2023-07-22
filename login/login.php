<?php
session_start();

include('../_functions.php');
$pdo = connect_to_db();

//データの受け取り
$email = $_POST['email'];
$password = $_POST['password'];

// username，password，deleted_atの3項目全ての条件満たすデータを抽出する．
$sql = 'SELECT * FROM books_users WHERE  email = :email  AND password = :password AND deleted_at IS NULL';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email,PDO::PARAM_STR);
$stmt->bindValue(':password', $password,PDO::PARAM_STR);
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
  echo "<a href='login_form.php'>ログイン</a>";
  exit();
} else {
  $_SESSION = array();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $user['is_admin'];
  $_SESSION['username'] = $user['username'];

  header("Location:../bk_home2.php");
  exit();
}
?>
