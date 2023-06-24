<?php
//フォームからの値をそれぞれ変数に代入
$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);


$dsn = 'mysql:dbname=gs_d13_18;charset=utf8mb4;port=3306;host=localhost';
$username = 'root';
$password = '';
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

// SQL作成&実行
//フォームに入力されたmailがすでに登録されていないかチェック
$sql = "SELECT * FROM books_users WHERE mail = :mail";

$stmt = $dbh->prepare($sql);

// バインド変数を設定 ハッキング対策
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();

// SQL実行
if ($member['mail'] === (string)$mail) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    //登録されていなければinsert
    $sql = "INSERT INTO books_users(name, mail, pass) VALUES (:name, :mail, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':mail', $mail);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();
    $msg = '会員登録が完了しました';
    $link = '<a href="login_form.php">ログインページ</a>';
}
?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>
