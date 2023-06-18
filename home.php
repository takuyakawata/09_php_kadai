<?php

include('_header.php');

?>
<main>
        <h1>GOOGLE BOOKS での検索（とりあえず）</h1>
        <h1>できたら、楽天、アマゾンをつけてみる</h1>
        <h1>==================================</h1>

        <form class="btns" action="bk_search_create.php" method="POST">
            <div class="btn">
            <p>本の名前を入力してね！</p>
            <a href="books_read.php">タイトル履歴</a>
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
<section id="output">
            <!-- <div >　jsで検索ができた後に挿入される
                <section class="result">
                    <div class="img">
                    <img src="${response.data.items[i].volumeInfo.imageLinks.smallThumbnail}">
                    </div>
                    <div class="title">
                        <p>題名${response.data.items[i].volumeInfo.title}</p>
                    </div>
                    <div class="author">
                        <p>${response.data.items[i].volumeInfo.authors}</p>
                    </div>
                    <div class="link">
                        <a href="${response.data.items[i].volumeInfo.infoLink}">
                        <p>詳細</p>
                    </div>
                    </section>
            </div> -->

            </section>


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
