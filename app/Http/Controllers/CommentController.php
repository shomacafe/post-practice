<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request, $postId)
  {
    $request->validate([
      'body' => 'required',
    ]);


    $post = Post::findOrFail($postId);

    $comment = new Comment([
      'body' => $request->input('body'),
    ]);

    $comment->user()->associate(auth()->user());
    $post->comments()->save($comment);

    return redirect()->route('posts.index')->with('success', 'コメントが投稿されました');
  }

  public function edit(Comment $comment)
  {
    return view('comments.edit', compact('comment'));
  }

  public function update(Request $request, Comment $comment)
  {
    $request->validate([
      'body' => 'required',
    ]);

    $comment->update([
      'body' => $request->input('body'),
    ]);

    return redirect()->route('posts.index')->with('success', 'コメントが更新されました');
  }

  public function destroy(Comment $comment)
  {
    $comment->delete();

    return redirect()->route('posts.index')->with('success', 'コメントが削除されました');
  }
}
