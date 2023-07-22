<?php
// ----------------------------------------
// DB 接続の処理
function  connect_to_db(){
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
// ---------------------------------------
// ログイン状態のチェック関数　セッション変数（入力値）が違う、セッションidがセッション変数（入力値）と違う
function check_session_id() {

  if (!isset($_SESSION["session_id"]) ||$_SESSION["session_id"] !== session_id()) {
    header('Location:login/login_form.php');
    exit();

  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}

// // 管理者のみ編集、削除が可能なコード
// foreach ($result as $record) {
//   $output .= "
//     <tr>
//       <td>{$record["deadline"]}</td>
//       <td>{$record["todo"]}</td>";
//   if ($_SESSION['is_admin'] === (string)1) {
//     $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>
//       <td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
//   }
//   $output .= "
//     </tr>
//   ";
// }
// }

// -----------------------------