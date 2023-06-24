<?php
function connect_to_db()
// DB 接続の処理
{
    $dbn = 'mysql:dbname=gs_d13_18;charset=utf8mb4;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

// DB 接続情報を出力するように実装する
try {
  return new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
}
