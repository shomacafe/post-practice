@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('新しい投稿') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label for="title" class="form-label">{{ __('タイトル') }}</label>
              <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="body" class="form-label">{{ __('本文') }}</label>
              <textarea name="body" id="body" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">{{ __('画像') }}</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('投稿する') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
