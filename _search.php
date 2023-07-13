<?php
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

// SQL 作成&実行
$sql = 'SELECT * FROM books_search ORDER BY id DESC';

// データがちゃんと取れているか確認！！
// var_dump($sql);
// exit('どうなってる？');

//続きの処理
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理、データが正しく獲得された後の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);
// exit();

if (!empty($result)) {
  $record = $result[0]; // 先頭の要素を取得
    $word = "{$record["title"]}";
};
// 先頭の要素を,検索ワードにして、APIに入れる
// var_dump($word);
// exit()
?>

<form action="bk_search_create.php" method="POST">

<div class="flex justify-center">

    <div class="w-full max-w-xs mx-auto">
    <input name="title" id="keyword" type="text" placeholder="入力してね" class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
    </div>

    <button id="send" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
    タイトルで検索
    </button>

</div>

</form>