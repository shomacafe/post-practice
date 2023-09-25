@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>投稿一覧</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">投稿する</a>
    <a href="{{ route('export.posts') }}" class="btn btn-success">CSV出力</a>
    <ul class="list-group">
      @foreach ($posts as $post)
      <li class="list-group-item">
        <h4>{{ $post->title }}</h4>
        <p>{{ $post->body }}</p>
        @if ($post->image)
          <img src="{{ asset('storage/' . $post->image)}}" alt="{{ $post->title }}" width="300" />
        @else
          画像なし
        @endif

        <div class="btn-group">
          <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">編集</a>
          <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
          </form>
        </div>

        <form action="{{ route('comments.store', $post->id) }}" method="POST">
          @csrf
          <div class="form-group">
            <textarea name="body" class="form-control" placeholder="コメントを入力"></textarea>
            <button type="submit" class="btn btn-primary">コメントする</button>
          </div>
        </form>
        <ul class="list-group">
          @foreach ($post->comments as $comment)
            <li class="list-group-item">
              <strong>{{ $comment->user->name }}</strong>: {{ $comment->body }}
              <div class="btn-group">
                <a href="{{ route('comments.edit', $comment) }}" class="btn btn-primary">編集</a>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      </li>
      @endforeach
    </ul>
  </div>
@endsection
