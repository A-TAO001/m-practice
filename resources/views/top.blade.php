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
    <input type="submit" name="search" value="検索">
</form>
<div class="conteinar">
  <table class="menu">
    <thead>
      <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
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
          <button data-route="{{ route('deta', ['id' => $product->id]) }}" class="mini-btn blue detail-button">詳細</button>
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
@endsection
<!-- 一覧画面 -->