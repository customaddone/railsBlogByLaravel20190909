@extends('layouts.layouts')

@section('header')
    @component('components.header')
    @endcomponent
@endsection

@section('main')
    <h1>会員の詳細</h1>
    @if (session('administrator') == 1)
    <div class="toolbar"><a href="/users/{{ $item->id }}/edit">編集</a></div>
    @endif
        <table class="attr">
            <tr>
                <th width="150">背番号</th>
                <td>{{ $item->number }}</td>
            </tr>
            <tr>
                <th>ユーザー名</th>
                <td>{{ $item->name }}</td>
            </tr>
            <tr>
                <th>氏名</th>
                <td>{{ $item->full_name }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>{{ $sexCharacter }}</td>
            </tr>
            <tr>
                <th>誕生日</th>
                <td>{{ $birthdayCharacter }}</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $item->email }}</td>
            </tr>
            <tr>
                <th>管理者</th>
                <td>{{ $administratorMark }}</td>
            </tr>
        </table>
@endsection

@section('sidebar')
    @component('components.sidebar')
    @endcomponent
@endsection

@section('footer')
    @component('components.footer')
    @endcomponent
@endsection
