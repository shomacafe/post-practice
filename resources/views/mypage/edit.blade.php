@extends('layouts.app')

@section('content')
<div class="container">
  <h2>会員情報編集</h2>
  <form method="POST" action="{{ route('mypage.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" id="email" name="email" value="{{  old('email', auth()->user()->email) }}">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" value="{{  old('name', auth()->user()->name) }}">
    </div>
    <button type="submit" class="btn btn-primary">更新する</button>
  </form>
</div>
@endsection
