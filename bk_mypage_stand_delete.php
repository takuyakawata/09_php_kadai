<?php

$id = $_GET['id'];

include('_functions.php');
$pdo = connect_to_db();

$sql = 'DELETE FROM books_list WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:bk_mypage_stand_read.php");
exit();