<!-- Storage/app/public/images/に画像を置いた後にシンボリックリンクを貼る
     （ターミナルでphp artisan storage:linkする）
   　下記のアドレスを書くと画像が表示される -->
<img src="/storage/images/logo.gif" width="272px" height="48px">

<ul class="account-menu">
    @if(session('msg'))
    <p><a href="/users/{{ session('userId')}}/edit">{{ session('msg') }}</a>|<a href="/hello/destroy">ログアウト</a></p>
    @endisset
</ul>

<nav class="menubar">
    <ul>
        <!-- ビューヘルパーはapp/Myhelpersに置いています -->
        <?php menuLinkTo('TOP', "/hello"); ?><span> |</span>
        <?php menuLinkTo('ニュース', "/articles"); ?><span> |</span>
        <?php menuLinkTo('ブログ', "/entries"); ?><span> |</span>
        <?php menuLinkTo('会員名簿', "/users"); ?><span> |</span>
        <?php menuLinkTo('管理ページ', "/hello"); ?>
    </ul>
</nav>
