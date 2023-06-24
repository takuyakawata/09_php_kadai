<script>
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

// 蔵書検索を行う
    const libUrl2 =
        "http://api.calil.jp/check?appkey={}&isbn=4834000826&systemid=Aomori_Pref&format=json";

</script>