<?php
session_start();

include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

$sql = 'SELECT * FROM todo_table WHERE id=:id';

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
  <title>DB連携型本棚（編集画面）</title>
</head>

<form action="bk_mypage_stand_update.php" method="POST">
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
    <div>
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
    </fieldset>
  </form>

</body>
</html>