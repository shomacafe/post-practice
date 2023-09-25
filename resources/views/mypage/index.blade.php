@extends('layouts.app')

@section('content')
<div class="container">
  <h2>マイページ</h2>
  <a href="{{ route('mypage.edit') }}" class="btn btn-primary">プロフィール変更</a>
  <a href="{{ route('mypage.password.edit') }}" class="btn btn-primary">パスワード変更</a>
  <h3>投稿履歴</h3>
  <ul>
    @foreach ($user->posts as $post)
      <p>タイトル：{{$post->title}}</p>
      <p>本文：{{$post->body}}</p>
    @endforeach
  </ul>


  <h3>コメント履歴</h3>
  @foreach ($user->comments as $comment)
      <p>投稿：{{$comment->post->title}}</p>
      <p>コメント：{{$comment->body}}</p>
  @endforeach
</div>
@endsection
