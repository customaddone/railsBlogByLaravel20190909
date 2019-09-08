@extends('layouts.layouts')

@section('header')
    @component('components.header')
    @endcomponent
@endsection

@section('main')
    <h1>会員名簿</h1>
    <!-- 会員の検索
         RESTとはアプリケーションの設計方法の1つで、操作の対象となるリソースをURLを使って表し
         、それに対してHTTPメソッドの「GET」「POST」「DELETE」「PUT」を使って操作を行なうと
         いうもの。何をどうするかをHTTPメソッドから読み取ることができる。
         RestfulなアプリケーションにするためにはGETで取得、POSTで新規作成 etc.を行いたいので
       　検索はPOSTではなくGET（取得）で行いたい
         method="get"でurlにクエリパラメータが指定される -->
    <form action="{{ url('/users') }}" method="get">
        {{ csrf_field() }}
        <input type="text" name="keyword">
        <input type="submit" value="検索">
    </form>
    <!-- 新規登録 -->
    @if (session('administrator') == 1)
    <div class="toolbar"><a href="/users/create">会員の新規登録</a></div>
    @endif
    <!-- メンバー一覧表示 -->
    @isset($items)
    <table class="list">
        <thead>
            <tr>
                <th>背番号</th>
                <th>ユーザー名</th>
                <th>氏名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ( $items as $item )
            <tr>
                <td style="text-align: right">{{ $item->number }}</td>
                <!-- ユーザーの詳細にリンクしている -->
                <td><a href="/users/{{ $item->id }}">{{ $item->name }}</a></td>
                <td>{{ $item->full_name }}</td>
                <td>
                    @if (session('administrator') == 1)
                    <!-- 編集機能 -->
                    <a href="/users/{{ $item->id }}/edit">編集</a>
                    <!-- 削除機能
                         formはブロック要素なのでstyleでインラインにする
                         id = formでformに名前を付与する
                       　methodはpostで(method_fieldでdelete送信にする)-->
                    <form action="/users/{{ $item->id }}" id="form_{{ $item->id }}" method="post" style="display:inline">
                        <!-- 忘れないで -->
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <!-- hrefは#で構わない
                      　　　　data-idはJavaScriptで変数.dataset.idとした際にこのaタグ要素を呼び出すためのもの -->
                        <a href="#" data-id="{{ $item->id }}" onclick="deletePost(this);">削除</a>
                    </form>
                    <script>
                        function deletePost(e) {
                            'use strict';

                            /* 確認に対し「OK」を押した場合（trueを返す)場合に実行 */
                            if (confirm('are you sure?')) {
                              　/* getElementByIdでform（Elementオブジェクト)を呼び出し、submitする */
                                document.getElementById('form_' + e.dataset.id).submit();
                            }
                        }
                    </script>
                    @else
                    <p style="display: inline;">編集</p>
                    <p style="display: inline;">削除</p>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>会員情報がありません</p>
    @endisset
@endsection

@section('sidebar')
    @component('components.sidebar')
    @endcomponent
@endsection

@section('footer')
    @component('components.footer')
    @endcomponent
@endsection
