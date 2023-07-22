<?php
session_start();
include("_functions.php");
check_session_id();

//titleがなければ、エラー
if (
  !isset($_POST['title']) || $_POST['title'] === ''
 ) {
  exit('paramError');
};
// データの受け取り
// $book_cover = $_POST['book_cover'];//本の表紙（写真　または、API
$title = $_POST['title'];//タイトル
$author = $_POST['author'];//著者
$content= $_POST['content'];//内容
$company = $_POST['company'];//出版社
$released_day = $_POST['released_day']; //発売日
$isbn = $_POST['isbn'];//isbn(本の登録番号)

//データベースに接続する（＿functions.php使用
$pdo = connect_to_db();

//update
$sql = "UPDATE books_list SET title=:title, author=:author, content=:content, company=:company, released_day=:released_day, isbn=:isbn ,created_at, updated_at=now(), deleted_at=NULL  WHERE id=:id";

// データをsqlで作成をする
$sql = 'INSERT INTO  books_list(id, title, author, content, company, released_day, isbn, created_at, updated_at, deleted_at) VALUES ( NULL, :title, :author, :content, :company, :released_day, :isbn, now(), now(),  NULL)';

//バインド変数の設定（データのハッキング対策）
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':company', $company, PDO::PARAM_STR);
$stmt->bindValue(':released_day', $released_day, PDO::PARAM_STR);
$stmt->bindValue(':isbn', $isbn, PDO::PARAM_STR);

//エラーが起きにくくする　変数に処理を格納する（一つの内容に定義づける的な？かんじかな、今はよくわからんでも動けばおっけ
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:bk_mypage_stand_read.php");
exit();
