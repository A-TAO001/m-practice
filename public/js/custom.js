

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

$(function() {

    $('#fav-table').tablesorter({
            headers: {
               1: { sorter: false },
               2: { sorter: false },
               5: { sorter: false },
               6: { sorter: false }
            }
    });

// フリー・メーカー検索
    // 検索ボタンのクリックイベントをキャッチ
    $('#search-button').on('click', function () {
        // 検索フォームのデータを取得
        var formData = $('form.search').serialize();

        // Ajaxリクエストを実行
        $.ajax({
            type: 'POST',
            url: "/top/search",
            data: $('form.search').serialize(),
            dataType: 'html', // レスポンスのデータタイプをHTMLとして指定

        }).done(function(data){
            let newTable = $(data).find('.table')
            $('.table').html(newTable)
            $('.table').tablesorter({
                headers: {
                   1: { sorter: false },
                   2: { sorter: false },
                   5: { sorter: false },
                   6: { sorter: false }
                }
        });

        }).fail(function(data) {
            alert('通信失敗');
        });
    });

    // 価格検索
    // 検索ボタンのクリックイベントをキャッチ
    $('#ps-search-button').on('click', function () {
        // 検索フォームのデータを取得
        var formData = $('.ps_search_form').serialize();

        // Ajaxリクエストを実行
        $.ajax({
            type: 'POST',
            url: "/top/pssearch",
            data: $('.ps_search_form').serialize(),
            dataType: 'html', // レスポンスのデータタイプをHTMLとして指定

        }).done(function(data){
            let newTable = $(data).find('.table')
            $('.table').html(newTable)
            $('.table').tablesorter({
                headers: {
                1: { sorter: false },
                2: { sorter: false },
                5: { sorter: false },
                6: { sorter: false }
                }
        });

        }).fail(function(data) {
            alert('通信失敗');
        });
    });

 });





    // 削除
    $('.btn_s').on('click', function(event) {
        event.preventDefault();

        // クリックした情報を入れる
        let clickEle = $(this);
        let deleteId = clickEle.attr('data-delete_id');

        // 確認ダイアログを表示
        if (confirm('削除しますか？')) {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'POST',
                url: 'delete/' + deleteId,
                data: {'id': deleteId}

            }).done(function() {

                clickEle.parents('tr').remove();

            }).fail(function() {

                alert('通信失敗');

            });
        }
    });


// topへボタン
var topButtons = document.querySelectorAll(".top-button");

topButtons.forEach(function(button) {
    button.addEventListener("click", function() {
        var route = this.getAttribute("data-route");
        window.location.href = route;
    });
});

// 編集ボタン

var editButtons = document.querySelectorAll(".edit-button");

editButtons.forEach(function(button) {
    button.addEventListener("click", function() {
        var route = this.getAttribute("data-route");
        window.location.href = route;
    });
});


// 新規作成ボタン
document.getElementById("entry-button").addEventListener("click", function() {
    var route = this.getAttribute("data-route");
    window.location.href = route;
    });

    //編集ボタン
    document.addEventListener("DOMContentLoaded", function() {
    var detaButtons = document.querySelectorAll(".deta-button");


    detaButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            var route = this.getAttribute("data-route");
            window.location.href = route;
        });
    });
});