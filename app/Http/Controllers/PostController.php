<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  // 投稿一覧
  public function index()
  {
    $posts = Post::all();

    return view('posts.index', ['posts' => $posts]);
  }

  // 投稿作成フォーム
  public function create()
  {
    return view('posts.create');
  }

  // 投稿を登録
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|max:60',
      'body' => 'required',
      'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post = new Post;
    $post->title = $request->title;
    $post->body = $request->body;
    $post->user()->associate(auth()->user());

    // 画像アップロード
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('public/images');
      $post->image = str_replace('public/', '', $imagePath);
    }

    $post->save();

    return redirect('/')->with('success', '投稿が作成されました。');
  }

  // 投稿編集フォーム
  public function edit($id)
  {
    $post = Post::findOrFail($id);
    return view('posts.edit', ['post' => $post]);
  }

  // 投稿を更新
  public function update(Request $request, Post $post)
  {
    $request->validate([
      'title' => 'required|max:60',
      'body' => 'required',
      'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post->title = $request->title;
    $post->body = $request->body;
    $post->user_id = Auth::id();

    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('public/images');
      $post->image = str_replace('public/', '', $imagePath);
    }

    $post->save();

    return redirect('/')->with('success', '投稿が更新されました');
  }

  // 論理削除
  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect('/')->with('success', '投稿が削除されました');
  }

  // CSV出力
  public function exportCSV()
  {

    $csvHeader = ['投稿者', 'タイトル', '本文'];
    $csvData = [];

    $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
      ->select('users.name as user_name', 'posts.title', 'posts.body')
      ->get();

    foreach ($posts as $post) {
      $userName = $post->user_name ? $post->user_name : '名前未登録';
      $csvData[] = [
        $userName,
        $post->title,
        $post->body,
      ];
    }

    $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
      $handle = fopen('php://output', 'w');
      fputcsv($handle, $csvHeader);

      foreach ($csvData as $row) {
        fputcsv($handle, $row);
      }

      fclose($handle);
    }, 200, [
      'Content-Type' => 'text/csv',
      'Content-Disposition' => 'attachment; filename="posts.csv"',
    ]);

    return $response;
  }
}
