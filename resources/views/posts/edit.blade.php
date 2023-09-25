@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('投稿を編集') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="title" class="form-label">{{ __('タイトル') }}</label>
              <input type="text" name="title" id="title" class="form-control" required value="{{ $post->title }}">
            </div>
            <div class="mb-3">
              <label for="body" class="form-label">{{ __('本文') }}</label>
              <textarea name="body" id="body" class="form-control" required>{{ $post->body }}</textarea>
            </div>
            <div class="mb-3">
              <label for="current_image" class="form-label">{{ __('現在の画像') }}</label>
              @if ($post->image)
                <img src="{{ asset('storage/' . $post->image)}}" alt="{{ $post->title }}" width="100" />
              @else
                画像なし
              @endif
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">{{ __('新しい画像を選択') }}</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('更新する') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
