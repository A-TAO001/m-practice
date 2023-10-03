@extends('layout')

@section('content')
<form action="{{ route('purchase') }}" method="post">
  @csrf
  <input type="text" name="product_id">
  <input type="submit" value="登録">
</form>
<a href="{{route('top')}}">一覧へ</a>
@endsection
<!-- 更新画面 -->
