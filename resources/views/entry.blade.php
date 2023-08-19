@extends('layout')

@section('content')
<h1>商品登録</h1>
<div class="deta-conteinar">
  <div class="left">
    <ul class="entry-menu">
      <li>商品名</li>
      <li>メーカー名</li>
      <li>価格</li>
      <li>在庫数</li>
      <li>コメント</li>
      <li>画像ファイル</li>
    </ul>
  </div>
  <div class="right">
    <form method="post" action="{{route('product_entry')}}" enctype="multipart/form-data">
    @csrf
<ul class="entry-menu">
 <li><input type="text" name="product_name" ></li>
    @error('product_name')
        <span class="error">{{ $message }}</span>
    @enderror
 <li><select name="company_id" id="company_name">
      @foreach($companies as $company)
      <option value="{{$company->id}}">{{ $company->company_name }}</option>
      @endforeach
    </select></li>
    <li><input type="text" name="price"></li>
    @error('price')
        <span class="error">{{ $message }}</span>
    @enderror
    <li><input type="text" name="stock"></li>
    @error('stock')
        <span class="error">{{ $message }}</span>
    @enderror
    <li><textarea name="comment" id=""></textarea></li>
    @error('comment')
        <span class="error">{{ $message }}</span>
    @enderror
    <li><input type="file" name="img_path" ></li>
    @error('img_path')
        <span class="error">{{ $message }}</span>
    @enderror
</ul>
  </div>
</div>
<input type="submit" value="登録">
</form>
<button data-route="{{ route('top') }}" class="auth_btn orange top-button">戻る</button>
@endsection
<!-- 登録画面 -->