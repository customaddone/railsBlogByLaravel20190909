<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelloController extends Controller
{
    public function index()
    {
        if (session('msg'))
        {
            $articles = Article::visible('released_at')->get();
        } else {
            $articles = Article::visible('released_at')->where('member_only', 0)
                        ->get();
        }
        return view('hello.index',  ['page_title' => 'Home',
                    'articles' => $articles]);

    }
    /* ログイン認証は自作しました */
    public function postAuth(Request $request)
    {
        $authEmail = $request->authEmail;
        $password = $request->password;
        // Auth::attemptでこのemail,passwordの人はいるか確認する
        if (Auth::attempt(['email' => $authEmail, 'password' => $password]))
        {
            $state = Auth::user()->name .'さん';
            /* 右上の名前表示用*/
            $request->session()->put('msg', $state);
            /* 現在認証されているユーザーのIdを渡す */
            $request->session()->put('userId', Auth::id());
            /* これがtrueなら会員情報を編集できる */
            $request->session()->put('administrator', Auth::user()->administrator);
            /* ログイン失敗の状態を消す */
            session()->forget('loginError');
            return redirect('/users');
        } else {
            $request->session()->put('loginError', 'Emailとパスワードが一致しません');
            return redirect('/users');
        }
    }

    public function postDestroy()
    {
        session()->forget('msg');
        session()->forget('userId');
        session()->forget('administrator');
        return redirect('/users');
    }
}
