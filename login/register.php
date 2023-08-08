<?php
// 入力されたデータを送信
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// DBの接続
include('../_functions.php');
$pdo = connect_to_db();

/// SQL参照
$sql = "SELECT * FROM books_users WHERE email = :email AND deleted_at IS NULL";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);

try {
  $status = $stmt->execute();

} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// sqlの実行　　実行結果を連装配列にしている
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);
// exit();


//フォームに入力されたemailがすでに登録されていないかチェック

// フォームに入力されたemailがすでに登録されていないかチェック
if (!empty($result)) {
    foreach ($result as $row) {
        if ($row['email'] === $email) {
            $msg = '同じメールアドレスが存在します。';
            $link = '<a href="signup.php">戻る</a>';
            exit(); // エラーメッセージを表示したら処理を終了する
        }
    }


} else { 
    //登録されていなければinsert
    $sql = 'INSERT INTO books_users(id, username, email, password, is_admin, created_at, updated_at, `deleted_at`) VALUES ( NULL ,:username, :email, :password,  0,  now(),  now(),  NULL)';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  
    // SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();

} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

    $msg = '会員登録が完了しました';
    $link = '<a href="login_form.php">ログインページ</a>';
}

// ----------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>メンバー登録</title>

<link rel="stylesheet" href="css/bk_search.css">

<!-- firebase -->
    <script src="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.js"></script>

<link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.css" />
<!-- map -->
    <script src="https://cdn.jsdelivr.net/gh/yamazakidaisuke/BmapQuery/js/BmapQuery.js"></script>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- axios -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- googleBooksAPI -->
<script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>

<!-- bingMap -->
<script
    src="https://www.bing.com/api/maps/mapcontrol?mkt=ja-jp&key=AqcwE4abAtRFTiK8xl_Hcl35LxP0D8YT8NptLKATGrPItDqV-1yxYGNN8nXN-Tis"></script>

<!-- tailwindCSS -->
<script src="https://cdn.tailwindcss.com"></script>
</head>



<main>
<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>

</main>