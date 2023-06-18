<?php
// まずは`var_dump($_POST);`で値を確認すること！！
// var_dump($_POST);
// exit();
// ========================
// 検索のデータの受け取り
// ========================

// --------------------------------------
// 検索したデータ取得
if(
    !isset($_POST['title']) || $_POST['title'] === ''
){
    exit('データが足りません');
}

$title = $_POST['title'];

// -------------------------------------
// 各種項目設定（自分が送りたい場所の指定
$dbn ='mysql:dbname=gs_d13_18;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

//---------------------------------------
// DB接続(決まった書き方として考える
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．

// --------------------------------------
// SQL作成&実行
// 自分がしたいデータのセレクトの条件を記述
$sql = 'INSERT INTO books_search (`id`, `title`, `date`) VALUES (NULL, :title, now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定 ハッキング対策
$stmt->bindValue(':title', $title, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
    $status = $stmt->execute();

} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

// データ入力画面に移動する
header("Location:bk_search_home.php");
?>
