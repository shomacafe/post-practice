@extends('layouts.app')

@section('content')
<div class="container">
    <h2>コメント編集</h2>
    <form method="POST" action="{{ route('comments.update', ['comment' => $comment->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="body" class="form-label">{{ __('コメント') }}</label>
            <textarea name="body" id="body" class="form-control" required>{{ $comment->body }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('更新する') }}</button>
    </form>
</div>
@endsection
