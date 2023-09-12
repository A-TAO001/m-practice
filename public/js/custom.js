
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
    var detaButtons = document.querySelectorAll(".deta-button");
    var deleteButtons = document.querySelectorAll(".delete-button");

    detaButtons.forEach(function(button) {
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

    // フリー・メーカー検索
    $(document).ready(function () {
        // 検索ボタンのクリックイベントをキャッチ
        $('#search-button').on('click', function () {

            // 検索フォームのデータを取得
            var formData = $('form.search').serialize();

            // Ajaxリクエストを実行
            $.ajax({
                type: 'POST',
                url: "/top/search",
                data: formData,
                success: function (data) {
                    // JSONデータを解析
                    var products = data.products;
                    var companies = data.companies;

                    // HTMLテーブルのtbody要素を取得
                    var tbody = $('.conteinar table tbody');

                    // 商品情報をHTMLテーブルに追加
                    tbody.empty(); // 既存の行をクリア

                    products.data.forEach(function (product, index) {
                        // 商品情報を行に追加
                        var rowClass = index % 2 === 0 ? 'white' : 'light-blue';
                        var newRow = $('<tr class="' + rowClass + '">');
                        newRow.append('<td>' + product.id + '</td>');

                        // 修正: 商品画像のパスを正しく指定
                        var imgPath =  product.img_path;
                        newRow.append('<td class="product-img"><img src="' + product.img_path + '" alt=""></td>');

                        newRow.append('<td>' + product.product_name + '</td>');
                        newRow.append('<td>￥' + product.price + '</td>');
                        newRow.append('<td>' + product.stock + '</td>');

                        // 商品に関連するメーカー名を検索
                        var companyName = '';
                        companies.forEach(function (company) {
                            if (company.id === product.company_id) {
                                companyName = company.company_name;
                            }
                        });
                        newRow.append('<td>' + companyName + '</td>');

                        // 詳細ボタンと削除ボタンのURLを設定
                        var routeToDeta = "{{ route('deta', ['id' => '']) }}";
                        var routeToDelete = "{{ route('delete', ['id' => '']) }}";
                        var detaButton = '<button data-route="' + routeToDeta + '/' + product.id + '" class="mini-btn blue deta-button">詳細</button>';
                        var deleteButton = '<button data-route="' + routeToDelete + '/' + product.id + '" class="mini-btn red delete-button">削除</button>';
                        newRow.append('<td>' + detaButton + ' ' + deleteButton + '</td>');

                        // 新しい行をテーブルのtbodyに追加
                        tbody.append(newRow);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });


    // 価格検索
    $(document).ready(function () {
        // 検索ボタンのクリックイベントをキャッチ
        $('#price-search-button').on('click', function () {
            // 検索フォームのデータを取得
            var formData = $('.price_search_form').serialize();
    
            // CSRFトークンを取得
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            // Ajaxリクエストを実行
            $.ajax({
                type: 'POST',
                url: "/top/price_search",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // CSRFトークンをヘッダーに追加
                },
                success: function (data) {
    
                    // JSONデータを解析
                    var products = data.products;
                    var companies = data.companies;

                    // HTMLテーブルのtbody要素を取得
                    var tbody = $('.conteinar table tbody');

                    // 商品情報をHTMLテーブルに追加
                    tbody.empty(); // 既存の行をクリア

                    products.data.forEach(function (product, index) {
                        // 商品情報を行に追加
                        var rowClass = index % 2 === 0 ? 'white' : 'light-blue';
                        var newRow = $('<tr class="' + rowClass + '">');
                        newRow.append('<td>' + product.id + '</td>');

                        // 修正: 商品画像のパスを正しく指定
                        var imgPath = product.img_path;
                        newRow.append('<td class="product-img"><img src="' + imgPath + '" alt=""></td>');

                        newRow.append('<td>' + product.product_name + '</td>');
                        newRow.append('<td>￥' + product.price + '</td>');
                        newRow.append('<td>' + product.stock + '</td>');

                        // 商品に関連するメーカー名を検索
                        var companyName = '';
                        companies.forEach(function (company) {
                            if (company.id === product.company_id) {
                                companyName = company.company_name;
                            }
                        });
                        newRow.append('<td>' + companyName + '</td>');

                         // 詳細ボタンと削除ボタンのURLを設定
                        var routeToDeta = "{{ route('deta', ['id' => '']) }}";
                        var routeToDelete = "{{ route('delete', ['id' => '']) }}";
                        var detaButton = '<button data-route="' + routeToDeta + '/' + product.id + '" class="mini-btn blue deta-button">詳細</button>';
                        var deleteButton = '<button data-route="' + routeToDelete + '/' + product.id + '" class="mini-btn red delete-button">削除</button>';
                        newRow.append('<td>' + detaButton + ' ' + deleteButton + '</td>');


                        // 新しい行をテーブルのtbodyに追加
                        tbody.append(newRow);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

        // 在庫検索
    $(document).ready(function () {
        // 検索ボタンのクリックイベントをキャッチ
        $('#stock-search-button').on('click', function () {
            // 検索フォームのデータを取得
            var formData = $('.stock_search_form').serialize();
    
            // CSRFトークンを取得
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            // Ajaxリクエストを実行
            $.ajax({
                type: 'POST',
                url: "/top/stock_search",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // CSRFトークンをヘッダーに追加
                },
                success: function (data) {
    
                    // JSONデータを解析
                    var products = data.products;
                    var companies = data.companies;

                    // HTMLテーブルのtbody要素を取得
                    var tbody = $('.conteinar table tbody');

                    // 商品情報をHTMLテーブルに追加
                    tbody.empty(); // 既存の行をクリア

                    products.data.forEach(function (product, index) {
                        // 商品情報を行に追加
                        var rowClass = index % 2 === 0 ? 'white' : 'light-blue';
                        var newRow = $('<tr class="' + rowClass + '">');
                        newRow.append('<td>' + product.id + '</td>');

                        // 修正: 商品画像のパスを正しく指定
                        var imgPath = product.img_path;
                        newRow.append('<td class="product-img"><img src="' + imgPath + '" alt=""></td>');

                        newRow.append('<td>' + product.product_name + '</td>');
                        newRow.append('<td>￥' + product.price + '</td>');
                        newRow.append('<td>' + product.stock + '</td>');

                        // 商品に関連するメーカー名を検索
                        var companyName = '';
                        companies.forEach(function (company) {
                            if (company.id === product.company_id) {
                                companyName = company.company_name;
                            }
                        });
                        newRow.append('<td>' + companyName + '</td>');

                         // 詳細ボタンと削除ボタンのURLを設定
                        var routeToDeta = "{{ route('deta', ['id' => '']) }}";
                        var routeToDelete = "{{ route('delete', ['id' => '']) }}";
                        var detaButton = '<button data-route="' + routeToDeta + '/' + product.id + '" class="mini-btn blue deta-button">詳細</button>';
                        var deleteButton = '<button data-route="' + routeToDelete + '/' + product.id + '" class="mini-btn red delete-button">削除</button>';
                        newRow.append('<td>' + detaButton + ' ' + deleteButton + '</td>');


                        // 新しい行をテーブルのtbodyに追加
                        tbody.append(newRow);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });



    // 削除ボタンのクリックイベントをキャッチ
    document.addEventListener("DOMContentLoaded", function() {
        var deleteButtons = document.querySelectorAll(".delete-button");

        deleteButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();

                if (confirm("本当に削除しますか？")) {
                    var deleteUrl = this.getAttribute("data-route");

                    // 商品を削除するAjaxリクエストを送信
                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        success: function(data) {
                            // 成功時の処理（例: ページをリロードまたは一覧から該当行を削除）
                            location.reload(); // ページをリロードして一覧を更新
                        },
                        error: function(xhr, status, error) {
                            // エラー時の処理
                            console.error(error);
                        }
                    });
                }
            });
        });
    });



