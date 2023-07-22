<?php
session_start();
include("_functions.php");
check_session_id();

$pdo = connect_to_db();

$user_id = $_SESSION['user_id'];
// var_dump($user_id);
// exit();

$sql = 'SELECT * FROM books_list LEFT OUTER JOIN (SELECT  list_id, COUNT(id)AS
 books_list FROM books_users GROUP BY list_id)

AS users_list ON books_list.id = result_table.todo_id';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";

foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record[""]}</td>
      <td>{$record[""]}</td>

      <td><a href='like_create.php?user_id={$user_id}&_id={$record["id"]}'>like{$record["like_count"]}</a></td>

      <td><a href='bk_mypage_stand_edit.php?id={$record["id"]}'>edit</a></td>

      <td><a href='bk_mypage_stand_delete.php?id={$record["id"]}'>delete</a></td>
      
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型本棚read（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型本棚read（一覧画面）</legend>
    <a href="todo_input.php">入力画面</a>
    <a href="todo_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>