
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

    $(function() {

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
            }).fail(function(data) {
                alert('通信失敗');
            });
        });


        });

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

    // ソート機能
    $(document).ready(function () {
        // テーブルヘッダーのクリックハンドラ
        $('th[data-sortable]').on('click', function () {
            var columnName = $(this).data('sortable'); // クリックされたヘッダーのソート対象カラム名

            // ソートリクエストをサーバーに送信
            $.ajax({
                type: 'GET',
                url: "sort", // 現在のURLにソートクエリを追加
                data: { sort: columnName }, // ソートカラム名を送信
                dataType: 'html',
            }).done(function(data){
                let newTable = $(data).find('.table')
                $('.table').html(newTable)
            }).fail(function(data) {
                alert('通信失敗');
            });
        });
     });


//     // 検索(試験中)
//     $(document).ready(function () {
//             // 検索ボタンのクリックイベントをキャッチ
//             $('#search-button').on('click', function () {
//                 $.ajax({
//                     type: 'POST',
//                     url: "/top/search",
//                     data:$('form.search').serialize(),
//                     dataType:'html'
//                 }).done(function(data){
//                     let newTable = $(data).find('.table')
//                     $('.table').html(newTable)
//                 });
//     });
// });

   // 価格検索
   $(document).ready(function () {
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
        }).fail(function(data) {
            alert('通信失敗');
        });
    });
});

    // 削除ボタンのクリックイベントをキャッチ
    // document.addEventListener("DOMContentLoaded", function() {
    //     var deleteButtons = document.querySelectorAll(".delete-button");

    //     deleteButtons.forEach(function(button) {
    //         button.addEventListener("click", function(event) {
    //             event.preventDefault();

    //             if (confirm("本当に削除しますか？")) {
    //                 var deleteUrl = this.getAttribute("data-route");

    //                 // 商品を削除するAjaxリクエストを送信
    //                 $.ajax({
    //                     type: 'DELETE',
    //                     url: deleteUrl,
    //                     success: function(data) {
    //                         // 成功時の処理（例: ページをリロードまたは一覧から該当行を削除）
    //                         location.reload(); // ページをリロードして一覧を更新
    //                     },
    //                     error: function(xhr, status, error) {
    //                         // エラー時の処理
    //                         console.error(error);
    //                     }
    //                 });
    //             }
    //         });
    //     });
    // });

    // 削除
    $('.btn_s').on('click', function(event) {
        event.preventDefault();

        //クリックした情報を入れる
        let clickEle = $(this);
        let deleteId = clickEle.attr('data-delete_id');

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
    });

