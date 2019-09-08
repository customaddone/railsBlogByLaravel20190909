@extends('layouts.layouts')

@section('header')
    @component('components.header')
    @endcomponent
@endsection

@section('main')
    @if (session('msg'))
        <h1>{{ session('msg')}}のブログ</h1>
        <div class="toolbar"><a href="/entries/create">ブログ記事の作成</a></div>
    @else
        <h1>会員のブログ</h1>
    @endif

    @foreach ( $entries as $entry )
        <h2>{{ $entry->title }}</h2>
        <p><?php echo str_limit( $entry->body ); ?></p>
        <!-- font-sizeを微調整する -->
        <a href="/entries/{{ $entry->id }}" style="font-size: 15px;">もっと読む</a>
        <ul class="entry-footer">
            @if (session('msg'))
            <li>{{ $entry->status }}</li>
                <!-- sessionの値は現在ログインしている人のID
                     entryの値は記事の作者のID-->
                @if (session('userId') == $entry->user_id)
                <li><a href="/entries/{{ $entry->id }}/edit" style="font-size: 13px;">編集</a><span> |</span></li>
                <!-- 　削除機能 -->
                <form action="/entries/{{ $entry->id }}" id="form_{{ $entry->id }}"
                    method="post" style="display:inline">
                    <!-- 忘れないで -->
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <!-- hrefは#で構わない
              　　　     　data-idはJavaScriptで変数.dataset.idとした際にこのaタグ要素を呼び出すためのもの -->
                    <li><a href="#" data-id="{{ $entry->id }}" onclick="deletePost(this);"
                        style="font-size: 13px;">削除</a><span> |</span></li>
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
                @endif
            @endif
            <li>
                <span>by </span><a href="users/{{ $entry->user->id }}">{{ $entry->user->name }}</a>
                <span> |</span>
            </li>
            <li>{{ $entry->posted_at }}<span> |</span></li>
        </ul>
    @endforeach
@endsection

@section('sidebar')
    @component('components.sidebar')
    @endcomponent
@endsection

@section('footer')
    @component('components.footer')
    @endcomponent
@endsection
