@extends('layout')

@section('content')
<h1>商品管理画面</h1>
<form action="{{ route('search') }}" method="POST" class="search">
    @csrf
    <input type="text" name="textbox" placeholder="フリーテキスト" class="mini-form">
    <select name="company_id" id="company_name" class="mini-form">
        <option value="">メーカーを選択してください</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
        @endforeach
    </select>
    <button type="button" data-search-url="{{ route('search') }}" id="search-button">検索</button>
</form>

<form action="{{ route('pssearch') }}" method="POST" class="ps_search_form">
    @csrf
    <input type="text" name="min_price" placeholder="最安値" class="minimini-form">
    <input type="text" name="max_price" placeholder="最高値" class="minimini-form"><br>
    <input type="text" name="min_stock" placeholder="最小在庫" class="minimini-form">
    <input type="text" name="max_stock" placeholder="最大在庫" class="minimini-form"><br>
    <button type="button" id="ps-search-button">検索</button>
</form>

<div class="conteinar">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格 <a href="{{ route('sort', ['sort' => 'price', 'direction' => 'asc']) }}">昇順</a> <a href="{{ route('sort', ['sort' => 'price', 'direction' => 'desc']) }}">降順</a></th>
        <th>在庫数 <a href="{{ route('sort', ['sort' => 'stock', 'direction' => 'asc']) }}">昇順</a> <a href="{{ route('sort', ['sort' => 'stock', 'direction' => 'desc']) }}">降順</a></th>
        <th>メーカー名</th>
        <th><button id="entry-button" data-route="{{route('entry_view')}}" class="btn orange">新規登録</button></th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $index => $product)
      <tr class="{{ $index % 2 === 0 ? 'white' : 'light-blue' }}">
        <td>{{ $product->id }}</td>
        <td class="product-img"><img src="{{ asset($product->img_path) }}" alt=""></td>
        <td>{{ $product->product_name }}</td>
        <td>￥{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->company->company_name }}</td>
        <td>
        <button data-route="{{ route('deta', ['id' => $product->id]) }}" class="mini-btn blue deta-button">詳細</button>

 

        <form id="deleteForm" action="{{ route('delete', ['id' => $product->id]) }}" method="post">
          @csrf
          <button data-delete_id="{{ $product->id }}" type="submit" class="btn_s" onclick="return confirm('削除しますか？')">削除</button>
        </form>


        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div id="pagination-links">
    <!-- ページネーションリンクがここに表示されます -->
    
</div>
<a href="{{route('top')}}">一覧へ</a>
@endsection
<!-- 一覧画面 -->