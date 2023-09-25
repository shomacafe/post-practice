@extends('layouts.app')

@section('content')
<div class="container">
    <h2>パスワード変更</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('mypage.password.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="current_password" class="form-label">現在のパスワード</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">新しいパスワード</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">新しいパスワード（確認用）</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">パスワード変更</button>
    </form>
</div>
@endsection
