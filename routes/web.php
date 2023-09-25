<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MyPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// 投稿一覧（トップページ）
Route::get('/', [PostController::class, 'index'])->name('posts.index');
// 投稿フォーム
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// 新しい投稿を登録
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// 投稿編集フォーム
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
// 投稿を更新
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
// 投稿を削除
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// コメント投稿
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
// コメント編集フォーム
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
// コメントを更新
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
// コメントを削除
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// CSV出力
Route::get('/export-posts', [PostController::class, 'exportCSV'])->name('export.posts');

// マイページ
Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.index');

// プロフィール編集
Route::get('/mypage/edit', [MyPageController::class, 'edit'])->name('mypage.edit');
Route::put('/mypage/update', [MyPageController::class, 'update'])->name('mypage.update');

// パスワード編集
Route::get('/mypage/password', [MyPageController::class, 'passwordEdit'])->name('mypage.password.edit');
Route::put('/mypage/password', [MyPageController::class, 'passwordUpdate'])->name('mypage.password.update');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
