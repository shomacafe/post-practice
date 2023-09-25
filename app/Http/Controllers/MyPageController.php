<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
  public function index()
  {
    $user = auth()->user();

    $user->load('posts', 'comments');

    return view('mypage.index', compact('user'));
  }

  // 会員情報編集
  public function edit()
  {
    return view('mypage.edit');
  }

  public function update(Request $request)
  {
    $user = auth()->user();

    $request->validate([
      'email' => 'required|email|unique:users,email,' . $user->id,
      'name' => 'required|string|max:255',
    ]);

     $user->update([
      'email' => $request->input('email'),
      'name' => $request->input('name'),
     ]);

     return redirect()->route('mypage.index')->with('success', '会員情報が更新されました');
  }

  // パスワード編集
  public function passwordEdit()
  {
    return view('mypage.password.edit');
  }

  public function passwordUpdate(Request $request)
  {
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->input('current_password'), $user->password)) {
        return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
    }

    $user->update([
        'password' => Hash::make($request->input('password')),
    ]);

    return redirect()->route('mypage.index')->with('success', 'パスワードが更新されました');
}
}
