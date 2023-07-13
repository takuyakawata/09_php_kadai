<?php
include('_header.php');

include('_head.php');

include('_username.php');
?>

<main>
  <p>GOOGLE BOOKS での検索（とりあえず）</p>

<?php
// 本の検索のフォーム
include('_search.php');
?>
    <div class="btn near_lib">
        <!-- <form action="lib_search.php"> -->

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
<section ></section>


<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <h2 class="sr-only">Products</h2>

    <div id="output" class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">

      <!-- <a href="${response.data.items[i].volumeInfo.infoLink}" class="group">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
          <img src="${response.data.items[i].volumeInfo.imageLinks.smallThumbnail}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">${response.data.items[i].volumeInfo.title}</h3>
        <h3 class="mt-4 text-sm text-gray-700">著者</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">
      ${truncateText(response.data.items[i].volumeInfo.description,120)}</p>
      </a> -->


      <!-- More products... -->
    </div>
  </div>
</div>


<div x-data="{
        imageGalleryOpened: false,
        imageGalleryActiveUrl: null,
        imageGalleryImageIndex: null,
        imageGalleryOpen(event) {
            this.imageGalleryImageIndex = event.target.dataset.index;
            this.imageGalleryActiveUrl = event.target.src;
            this.imageGalleryOpened = true;
        },
        imageGalleryClose() {
            this.imageGalleryOpened = false;
            setTimeout(() => this.imageGalleryActiveUrl = null, 300);
        },
        imageGalleryNext(){
            if(this.imageGalleryImageIndex == this.$refs.gallery.childElementCount){
                this.imageGalleryImageIndex = 1;
            } else {
                this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) + 1;
            }
            this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
        },
        imageGalleryPrev() {
            if(this.imageGalleryImageIndex == 1){
                this.imageGalleryImageIndex = this.$refs.gallery.childElementCount;
            } else {
                this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) - 1;
            }

            this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
            
        }
    }" 
    @image-gallery-next.window="imageGalleryNext()" 
    @image-gallery-prev.window="imageGalleryPrev()" 
    @keyup.right.window="imageGalleryNext();" 
    @keyup.left.window="imageGalleryPrev();"
    x-init="
        imageGalleryPhotos = $refs.gallery.querySelectorAll('img');
        for(let i=0; i<imageGalleryPhotos.length; i++){
            imageGalleryPhotos[i].setAttribute('data-index', i+1);
        }
    " 
    class="w-full h-full select-none">
    <div class="max-w-6xl mx-auto duration-1000 delay-300 opacity-0 select-none ease animate-fade-in-view" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
        <ul x-ref="gallery" id="gallery" class="grid grid-cols-2 gap-5 lg:grid-cols-5">
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-01.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 01"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-02.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 02"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-03.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 03"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-04.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 04"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-05.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 05"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-06.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 06"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-07.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 07"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-08.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 08"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-09.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 09"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-10.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 10"></li>
        </ul>
    </div>
    <template x-teleport="body">
        <div 
            x-show="imageGalleryOpened" 
            x-transition:enter="transition ease-in-out duration-300" 
            x-transition:enter-start="opacity-0" 
            x-transition:leave="transition ease-in-in duration-300" 
            x-transition:leave-end="opacity-0" 
            @click="imageGalleryClose" 
            @keydown.window.escape="imageGalleryClose" 
            x-trap.inert.noscroll="imageGalleryOpened"
            class="fixed inset-0 z-[99] flex items-center justify-center bg-black bg-opacity-50 select-none cursor-zoom-out" x-cloak>
            <div class="relative flex items-center justify-center w-11/12 xl:w-4/5 h-11/12"> 
                <div @click="$event.stopPropagation(); $dispatch('image-gallery-prev')" class="absolute left-0 flex items-center justify-center text-white translate-x-10 rounded-full cursor-pointer xl:-translate-x-24 2xl:-translate-x-32 bg-white/10 w-14 h-14 hover:bg-white/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                </div>
                <img 
                    x-show="imageGalleryOpened" 
                    x-transition:enter="transition ease-in-out duration-300" 
                    x-transition:enter-start="opacity-0 transform scale-50" 
                    x-transition:leave="transition ease-in-in duration-300" 
                    x-transition:leave-end="opacity-0 transform scale-50" 
                    class="object-contain object-center w-full h-full select-none cursor-zoom-out" :src="imageGalleryActiveUrl" alt="" style="display: none;">
                <div @click="$event.stopPropagation(); $dispatch('image-gallery-next');" class="absolute right-0 flex items-center justify-center text-white -translate-x-10 rounded-full cursor-pointer xl:translate-x-24 2xl:translate-x-32 bg-white/10 w-14 h-14 hover:bg-white/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                </div>
            </div>
        </div>
    </template>
</div>
<!-- <div>
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
        </div> -->

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


        // 配列を作る
        const array =[];
        for(let i = 0; i<response.data.items.length; i++){

        // 配列に入れる
        array.push(`

        <a href="${response.data.items[i].volumeInfo.infoLink}" class="group">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
          <img src="${response.data.items[i].volumeInfo.imageLinks.smallThumbnail}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">${response.data.items[i].volumeInfo.title}</h3>
        <h3 class="mt-4 text-sm text-gray-700">${response.data.items[i].volumeInfo.authors}</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">
      ${truncateText(response.data.items[i].volumeInfo.description,120)}</p>
      </a>

        `);
//         array.push(`
// <div class="flex flex-col overflow-hidden bg-white rounded shadow-md sm:flex-row text-slate-500 shadow-slate-200">
// <!-- Image -->
//   <figure class="flex-1">
//       <a href="${response.data.items[i].volumeInfo.infoLink}" target="_blank" > <img src="${response.data.items[i].volumeInfo.imageLinks.smallThumbnail}" alt="card image"  class="object-cover min-h-full aspect-auto"/>
//       </a>
//   </figure>
//   <!-- Body-->
//   <div class="flex-1 p-6 sm:mx-6 sm:px-0">
//     <div class="flex gap-4 mb-4">

//       <div>
//         <h3 class="text-xl font-medium text-slate-700">${response.data.items[i].volumeInfo.title}</h3>
//       </div>

//     </div>
//     <p>
//       ${truncateText(response.data.items[i].volumeInfo.description,120)}
//     </p>
//   </div>
// </div>
// <!-- End Horizontal card-->

//         `);
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
<!-- -------------------------------- -->

<?php
include('_footer.php');