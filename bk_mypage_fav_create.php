<?php
//セッションの設定　ログインをしていないと使えない
session_start();
include("_functions.php");
check_session_id();

$user_id = $_SESSION['user_id'];

// POSTリクエストから送信されたデータを取得
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // データの受け取り
    // $book_cover = $_POST['book_cover'];//本の表紙（写真　または、API
    $title = $_POST['title'];//タイトル
    $author = $_POST['author'];//著者
    $content= $_POST['content'];//内容
    $company = $_POST['company'];//出版社
    $released_day = $_POST['released_day']; //発売日
    $isbn = $_POST['isbn'];//isbn(本の登録番号)

    // 他の必要な情報もここで取得する場合は、同様に取得します

    //データベースに接続する（＿functions.php使用
    $pdo = connect_to_db();

    // データをデータベースに挿入するクエリを作成
    $sql = "INSERT INTO books_list (title, authors) VALUES ('$bookTitle', '$bookAuthors')";
    // 他の必要な情報も挿入する場合は、同様に記述します
    // データをsqlで作成をする
    $sql = 'INSERT INTO  books_list(id, title, author, content, company, released_day, isbn, created_at, updated_at, deleted_at,user_id) VALUES ( NULL, :title, :author, :content, :company, :released_day, :isbn, now(), now(),  NULL, :user_id)';

        //バインド変数の設定（データのハッキング対策）
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':author', $author, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':company', $company, PDO::PARAM_STR);
    $stmt->bindValue(':released_day', $released_day, PDO::PARAM_STR);
    $stmt->bindValue(':isbn', $isbn, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

    // クエリを実行し、挿入が成功したかどうかをチェック
    if ($conn->query($sql) === TRUE) {
        echo "本の情報をデータベースに保存しました。";
    } else {
        echo "データベースエラー: " . $conn->error;
    }

    // データベース接続を閉じる
    $conn->close();
}

//エラーが起きにくくする　変数に処理を格納する（一つの内容に定義づける的な？かんじかな、今はよくわからんでも動けばおっけー
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:bk_home2.php");
exit();
