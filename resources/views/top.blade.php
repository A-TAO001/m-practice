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
  <ul class="menu">
    <li>ID</li>
    <li>商品画像</li>
    <li>商品名</li>
    <li>価格</li>
    <li>在庫数</li>
    <li>メーカー名</li>
    <button id="entry-button" data-route="{{route('entry_view')}}" class="btn orange">新規登録</button>
  </ul>
    @foreach($products as $index => $product)
    <ul class="menu product {{ $index % 2 === 0 ? 'white' : 'light-blue' }}" >
    <li>{{$product->id}}</li>
    <li class="product-img"><img src="{{asset($product->img_path)}}" alt=""></li>
    <li>{{$product -> product_name}}</li>
    <li>￥{{$product->price}}</li>
    <li>{{$product->stock}}</li>
    <li>{{$product->company->company_name}}</li>

    <button data-route="{{ route('deta', ['id' => $product->id]) }}" class="mini-btn blue detail-button">詳細</button>
    <button data-route="{{ route('delete', ['id' => $product->id]) }}" class="mini-btn red delete-button">削除</button>
    </ul>
    @endforeach
  </div>
  <nav class="pagination">
  {{ $products->links('vendor.pagination.default') }}
  </nav>
@endsection
<!-- 一覧画面 -->