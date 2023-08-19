
// topへボタン
document.addEventListener("DOMContentLoaded", function() {
  var topButtons = document.querySelectorAll(".top-button");

  topButtons.forEach(function(button) {
      button.addEventListener("click", function() {
          var route = this.getAttribute("data-route");
          window.location.href = route;
      });
  });
});


// 編集ボタン
document.addEventListener("DOMContentLoaded", function() {
  var editButtons = document.querySelectorAll(".edit-button");

  editButtons.forEach(function(button) {
      button.addEventListener("click", function() {
          var route = this.getAttribute("data-route");
          window.location.href = route;
      });
  });
});


// 新規作成ボタン
document.getElementById("entry-button").addEventListener("click", function() {
  var route = this.getAttribute("data-route");
  window.location.href = route;
});

// 削除、編集ボタン
document.addEventListener("DOMContentLoaded", function() {
  var detailButtons = document.querySelectorAll(".detail-button");
  var deleteButtons = document.querySelectorAll(".delete-button");

  detailButtons.forEach(function(button) {
      button.addEventListener("click", function() {
          var route = this.getAttribute("data-route");
          window.location.href = route;
      });
  });

  deleteButtons.forEach(function(button) {
      button.addEventListener("click", function(event) {
          event.preventDefault();

          if (confirm("本当に削除しますか？")) {
              var deleteUrl = this.getAttribute("data-route");
              window.location.href = deleteUrl;
          }
      });
  });
});


