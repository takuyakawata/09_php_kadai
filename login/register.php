<?php

if (
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['pass']) || $_POST['pass'] === ''
) {
  exit('ParamError');
}


//フォームからの値をそれぞれ変数に代入
$name = $_POST['name'];
$email = $_POST['email'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);


// DB 接続の処理
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




// // SQL作成&実行
// //フォームに入力されたmailがすでに登録されていないかチェック
// $sql = "SELECT * FROM books_users WHERE email = :email";

// $stmt = $dbh->prepare($sql);

// // バインド変数を設定 ハッキング対策
// $stmt->bindValue(':email', $email);
// $stmt->execute();
// $member = $stmt->fetch();

// // SQL実行
// if ($member['email'] === (string)$email) {
//     $msg = '同じメールアドレスが存在します。';
//     $link = '<a href="signup.php">戻る</a>';
// } else {
    //登録されていなければinsert
    $sql = "INSERT INTO books_users(name, email, pass) VALUES ( :name, :email, :pass)";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
    // SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}



    $msg = '会員登録が完了しました';
    $link = '<a href="login_form.php">ログインページ</a>';

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログインフォーム</title>

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