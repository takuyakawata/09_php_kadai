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
// exit();

include('_header.php');

?>

 <main>
        <h1>GOOGLE BOOKS での検索（とりあえず）</h1>
        <h1>できたら、楽天、アマゾンをつけてみる</h1>
        <h1>==================================</h1>

        <form class="btns" action="bk_search_create.php" method="POST">

            <div class="btn">
            <p>本の名前を入力してね！</p>
            <a href="">タイトル履歴</a>
            <input  name="title" id="keyword" width="30" height="20">
            </input>
            <button id="send" class="search">タイトルで検索</button>
            </div>

            <div class="btn near_lib">
                <p>近くのと図書館にあるかな？</p>
                <div id="lib_result">     </div>
                <button id="lib_btn" class="search">図書館検索</button>
                <button id="lib2_btn" class="search">蔵書検索</button>
            </div>

        </form>

<!-- 検索した結果がここに出るようにする -->
<section id="output"></section>

</main>

<script>
//  =======================================
// GoogleBooksAPI
// =========================================
// -----------------------------------
// タイトルでの検索

// 1入力 inputのname=titleに入れたワード
// 2SQLに保存（データを作る,履歴データにもなる
// 3SQL→JSに一番新しいタイトルのデータを渡す
// 検索したいキーワードがurlのintitle以降に入る
// 4 3と同じ流れで、履歴から検索をかけることができるようにする
// -----------------------------------
// APIにリクエストを送信している
$("#send").on('click',function(){
const url = `https://www.googleapis.com/books/v1/volumes?q=intitle:<?php echo $word; ?>&maxResults=10`
console.log(url);

$("#output").html("");

axios.get(url)
    .then(function (response) {
        // リクエスト成功時の処理（responseに結果が入っている）
        console.log(response.data.items[1].volumeInfo.title);
        console.log(response.data.items[1].volumeInfo.authors);
        console.log(response.data.items[1].volumeInfo.publishedDate);
        console.log(response.data.items[1].volumeInfo.description);
        console.log(response.data.items[1].volumeInfo.imageLinks.smallThumbnail);
        console.log(response.data.items[1].volumeInfo.pageCount);

        const array =[];
        for(let i = 0; i<response.data.items.length; i++){

        array.push(
            `<div>
            <section class="result">
                <div class="img">
                <img src="${response.data.items[i].volumeInfo.imageLinks.smallThumbnail}">
                </div>
                <div class="title">
                    <p>${response.data.items[i].volumeInfo.title}</p>
                </div>
                <div class="description">
                    <p>${response.data.items[i].volumeInfo.description}</p>
                </div>
                <div class="author">
                    <p>${response.data.items[i].volumeInfo.authors}</p>
                </div>
                <div class="link">
                    <a href="${response.data.items[i].volumeInfo.infoLink}">
                    <p>詳細</p>
                </div>
                </section>
        </div>`);
            $("#output").html(array);
        };

        console.log(array);

    })
    .catch(function (error) {
        // リクエスト失敗時の処理（errorにエラー内容が入っている）
        console.log(error);
    })
    .finally(function () {
        // 成功失敗に関わらず必ず実行
        console.log("done!");
    });
});
</script>

<!-- 図書館機能
<script>
'use strict';
// 検索をかける
$("#lib_btn").on('click',function(){

const libUrl =
        "https://api.calil.jp/library?appkey={da280c479ff3323463183ff2c51aa5f5}&pref=山口県&city=山口市&limit=10";

axios.get(libUrl)
    .then(function (response) {
        // リクエスト成功時の処理（responseに結果が入っている）
        console.log(response);
        console.log(response);
        console.log(response);

    })
    .catch(function (error) {
        // リクエスト失敗時の処理（errorにエラー内容が入っている）
        console.log(error);
    })
    .finally(function () {
        // 成功失敗に関わらず必ず実行
        console.log("done!");
    });
});

// 蔵書検索を行う
$("#lib2_btn").on('click', function(){
    const libUrl2 =
        "http://api.calil.jp/check?appkey={da280c479ff3323463183ff2c51aa5f5}&isbn=4834000826&systemid=Aomori_Pref&format=json";
});

</script> -->


<?php

include('_footer.php');
