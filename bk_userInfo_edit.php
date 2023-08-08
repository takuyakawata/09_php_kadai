<?php
session_start();

include("_functions.php");
check_session_id();

$id = $_GET['id'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM books_users WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報（編集画面）</title>
</head>

<form action="bk_userInfo_update.php" method="POST">
    <fieldset>
      <legend>ユーザー情報の変更</legend>
      <a href="bk_mypage_stand_read.php">ユーザー情報</a>
    <!-- <div>
        画像: <input type="file" name="book_cover">
    </div> -->
    <div>
        username:<input type="text" name="username" value="<?= $record['username']?>">
    </div>
    <div>
        email:<input type="text" name="email" value="<?= $record['email'] ?>">
    </div>
    <div>
        password:<input type="password" name="password" value="<?= $record['password'] ?>">
    </div>
    <div>
        学校名:<input type="text" name="school_name" value="<?= $record['school_name'] ?>">
    </div>
    <div>
        学校種:<input type="text" name="school_kind" value="<?= $record['school_kind'] ?>">
    </div>
    <div>
        経験年数:<input type="text" name="school_year" value="<?= $record['school_year'] ?>">
    </div>
        <div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
    </div>

    <div>
        <button>submit</button>
    </div>
    </fieldset>
  </form>

</body>
</html>