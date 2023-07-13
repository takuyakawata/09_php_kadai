<?php
include('_header.php');
include('_username.php');
?>

<main>
<?php
// 本の検索のフォーム
include('_search.php');
?>

        <div class="btn near_lib">
            <!-- <form action="lib_search.php"> -->

            <p>現在使用不可</p><label for="city">市町村:</label>
            <input type="text" id="city" name="city" value="山口市">
            <button id="lib_btn" class="search">図書館検索</button>

            <!-- <p>近くの図書館</p> -->
            <div id="libraryInfo"></div>

            <div id="booksInfo"></div>

            <div><a href="https://calil.jp/" target="_blank">近くの図書館で探す</a></div>

            <!-- </form> -->

        </div>

        </form>

<!-- 検索した結果がここに出るようにする -->
<section id="output"></section>

</main>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
const url = `https://www.googleapis.com/books/v1/volumes?q=intitle:<?php echo $word; ?>&maxResults=10`

console.log(url);

$("#output").html("");
// 文字数の制限（２００文字まで）
function truncateText(text, maxLength) {
  if (text.length > maxLength) {
    return text.substring(0, maxLength) + " ...";
  } else {
    return text;
  }
}

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
                    <p>${truncateText(response.data.items[i].volumeInfo.description,120)}</p>
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



//  =======================================
// 検索　　カーリルAPI
// =========================================
// 図書館を検索して表示する
// 今は山口市の図書館検索
function loadLibraryData() {
  const libUrl =
  "https://api.calil.jp/library?appkey={8b7e2d73901869e2355f16a7b1a46434}&pref=山口県&city=山口市&limit=10&format=json";

   console.log(libUrl);

    axios.get(libUrl)
        .then(function(response) {
            let libraries = response.data;
            console.log(response.data.callback[1].formal);

            // 検索結果から図書館の情報を取得
            let library = libraries[0]; // 最初の図書館を表示する

            // 図書館の情報を表示
            displayLibrary(library);
        })
        .catch(function(error) {
            console.log(error);
        });
}
// ----------------------------------------
// ボタンを押したら図書館の検索結果を表示させる
$("#lib_btn").on('click',function(){

		loadLibraryData();

        function displayLibrary(library) {
        let libraryInfoDiv = document.getElementById("libraryInfo");
        libraryInfoDiv.innerHTML = `
            <p>図書館名: ${library.library_name}</p>
            <p>住所: ${library.address}</p>
            <p>電話番号: ${library.tel}</p>
            <p>ウェブサイト: <a href="${library.url_pc}">${library.url_pc}</a></p>
        `;
		}
});

</script>

<script>
// 蔵書検索機能
function searchBooks(libraryId) {
  let appKey = "da280c479ff3323463183ff2c51aa5f5";
  let isbn = "9784163741008"; // ファクトフルネスのISBN

  let booksUrl = `https://api.calil.jp/check?appkey=${appKey}&isbn=${isbn}&systemid=${libraryId}&format=json`;

  axios
    .get(booksUrl)
    .then(function (response) {
      let data = response.data;
      let libraryName = data.library.library_name;
      let books = data.books;

      displayBooks(libraryName, books);
    })
    .catch(function (error) {
      console.log(error);
    });
}

function displayBooks(libraryName, books) {
  let booksInfoDiv = document.getElementById("booksInfo");
  booksInfoDiv.innerHTML = "";

  let libraryHeader = document.createElement("h2");
  libraryHeader.textContent = libraryName;
  booksInfoDiv.appendChild(libraryHeader);

  for (let i = 0; i < books.length; i++) {
    let book = books[i];
    let bookTitle = book.title;
    let status = book.status;

    let bookInfo = document.createElement("p");
    bookInfo.textContent = `${bookTitle}: ${status}`;
    booksInfoDiv.appendChild(bookInfo);
  }
}

// 蔵書検索
    const libUrl2 =
        "http://api.calil.jp/check?appkey={da280c479ff3323463183ff2c51aa5f5}&isbn=4834000826&systemid=Aomori_Pref&format=json";

</script>


<?php

include('_footer.php');
