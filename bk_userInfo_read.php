<?php

include('_head.php');
include('_header.php');

$pdo = connect_to_db();

$user_id = $_SESSION['user_id'];
// var_dump($user_id);
// exit();

//対象のユーザーのみ表示することができるようにする
$sql = 'SELECT * FROM books_list WHERE user_id = :user_id';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";


foreach ($result as $record) {
  $output .= "
    <li class=\"my-9\">
        <img x-on:click=\"imageGalleryOpen\" src=\"\" class=\"object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]\" alt=\"photo gallery image 01\">

        <h2 class=\"mt-4 text-sm text-gray-700\">{$record["title"]}</h2>

        <h3 class=\"mt-4 text-sm text-gray-700\">{$record["author"]}</h3>

        <td>
        <a href='bk_mypage_stand_edit.php?id={$record["id"]}'  class=\"mt-4 text-xs text-gray-500\">訂正</a>
      </td>
      <td>
         <a href='bk_mypage_stand_delete.php?id={$record["id"]}' class=\"mt-4 text-xs text-gray-500\">削除</a>
      </td>
    </li>
  ";
}
  //  <td><a href='like_create.php?user_id={$user_id}&_id={$record["id"]}'>like{$record["like_count"]}</a></td>
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報（一覧画面）</title>
</head>

<body>
 
<div class="ml-5">
    <legend>ユーザー情報</legend>
    <!-- Component: Base outline elevated button -->
    <a href="bk_mypage_stand_input.php">
        <button class="inline-flex items-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 border rounded shadow-md focus-visible:outline-none whitespace-nowrap border-gray-500 text-gray-500 shadow-gray-200 hover:border-gray-600 hover:text-gray-600 focus:border-gray-700 focus:text-gray-700 hover:shadow-sm hover:shadow-gray-200 focus:shadow-sm focus:shadow-gray-200 disabled:cursor-not-allowed disabled:border-gray-300 disabled:text-gray-300 disabled:shadow-none">
        <span>本棚に登録</span>
        </button>
    </a>
</div>

<!-- End Base outline elevated button -->
    
    


<!-- 検索した結果を表示する画面 -->
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
        <ul id="output" x-ref="gallery" id="gallery" class="grid grid-cols-2 gap-10 lg:grid-cols-5">

        <?= $output ?>

            <!-- <li>
                <img x-on:click="imageGalleryOpen"src="${response.data.items[i].volumeInfo.imageLinks.smallThumbnail}" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 01">
                <h3 class="mt-4 text-sm text-gray-700">${response.data.items[i].volumeInfo.title}</h3>
                <h3 class="mt-4 text-sm text-gray-700">${response.data.items[i].volumeInfo.authors}</h3>
                <p class="mt-1 text-lg font-medium text-gray-900">
                ${truncateText(response.data.items[i].volumeInfo.description,120)}</p>
          </li>

            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-02.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 02"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-03.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 03"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-04.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 04"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-05.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 05"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-06.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 06"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-07.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 07"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-08.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 08"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-09.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 09"></li>
            <li><img x-on:click="imageGalleryOpen" src="https://cdn.devdojo.com/images/june2023/mountains-10.jpeg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 10"></li> -->
        </ul>

    </div>

    <template x-teleport="body">

        <div
            x-show="imageGalleryOpened"
            x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:leave="transition ease-in-in duration-300"
            x-transition:leave-end="opacity-30"
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


</main>

<?php
include('_footer.php');
?>

</body>

</html>