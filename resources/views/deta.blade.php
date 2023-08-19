@extends('layout')

@section('content')
<h1>商品詳細画面</h1>
<div class="deta-conteinar">
  <div class="left">
  <ul class="deta-menu">
    <li class="id">ID</li>
    <li class="img_file">商品画像</li>
    <li class="product_name">商品名</li>
    <li class="price">価格</li>
    <li class="stock">在庫数</li>
    <li class="maker_name">メーカー名</li>
    <li class="comment">コメント</li>
  </ul>
  </div>

  <div class="right">
    <ul class="deta-menu">
      <li class="id">{{ $product->id }}</li>
      <li class="img_file"><img src="{{asset($product->img_path) }}" alt=""></li>
      <li class="product_name">{{ $product->product_name }}</li>
      <li class="price">¥{{ $product->price }}</li>
      <li class="stock">{{ $product->stock }}</li>
      <li class="maker_name">{{ $product->company->company_name }}</li>
      <li class="comment">{{ $product->comment }}</li>
    </ul>
  </div>
 </div>
 <button data-route="{{ route('update_view', ['id' => $product->id]) }}" class="auth_btn green edit-button">編集</button>
 <button data-route="{{ route('top') }}" class="auth_btn orange top-button">戻る</button>
@endsection
<!-- 詳細画面 -->