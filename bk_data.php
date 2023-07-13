<?php
include('_header.php');
include('_username.php');
?>

</header>

<p>検索履歴</p>

<div>data</div>

<!-- 履歴に合わせて、画像にリンクをつけて保存することができる。 -->
<!-- Component: Basic image card -->
<div class="overflow-hidden bg-white rounded shadow-md text-slate-500 shadow-slate-200">
  <!--  Image -->
  <figure>
    <img src="https://picsum.photos/id/69/800/600" alt="card image" class="aspect-video w-full" />
  </figure>
  <!-- Body-->
  <div class="p-6">
    <div>
      <h3 class="text-xl font-medium text-slate-700">タイトル</h3>
      <p class="text-sm text-slate-400"> 著者</p>
      <p class="text-sm text-slate-400"> 検索日時</p>
    </div>
  </div>
</div>
<!-- End Basic image card -->


