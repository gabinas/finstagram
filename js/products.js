$(document).ready(function () {
  // Searchbar
  $("#searchSub").click(function (e) {
    e.preventDefault();
    var search = $("#searchVal").val();

    if (search != "") {
      $("#main-view").load("searchbar.php", {
        search: search,
      });
      $("#searchVal").val("");
    }
  });
});
