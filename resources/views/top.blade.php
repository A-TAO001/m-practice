-@extends('layout')

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

<form action="{{ route('price_search') }}" method="POST" class="price_search_form">
    @csrf
    <input type="text" name="min_price" placeholder="最安値" class="mini-form">
    <input type="text" name="max_price" placeholder="最高値" class="mini-form">
    <button type="button" id="price-search-button">検索</button>
</form>


<form action="{{route('stock_search')}}" method="POST" class="price_search_form">
    @csrf
    <input type="text" name="min_stock" placeholder="最小在庫" class="mini-form">
    <input type="text" name="max_stock" placeholder="最大在庫" class="mini-form">
    <button type="button" id="stock-search-button">検索</button>
</form>

<div class="conteinar">
  <table class="menu">
    <thead>
      <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>@sortablelink('price', '価格')</th>
        <th>@sortablelink('stock', '在庫数')</th>
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
        <button data-route="{{ route('delete', ['id' => $product->id]) }}" class="mini-btn red delete-button">削除</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<nav class="pagination">
  {{ $products->links('vendor.pagination.default') }}
</nav>
<a href="{{route('top')}}">一覧へ</a>
@endsection
<script>
    var imgPath = @json(asset($product->img_path));
</script>


<!-- 一覧画面 -->