<?php

include('_header.php');

?>

<main>
        <h1>（とりあえず home画面としておく）</h1>
        <h1>できたら、楽天、アマゾンをつけてみる</h1>
        <h1>==================================</h1>
       
</main>

<script type="text/javascript">
    google.books.load();

    function initialize() {
        var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
        viewer.load('ISBN:0738531367');
    }

    google.books.setOnLoadCallback(initialize);
</script>


<!-- 図書館機能 -->
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

</script>







<?php

include('_footer.php');
