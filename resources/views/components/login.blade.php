<h2>ログイン</h2>
<!-- 絶対パスにしないと編集画面から移動できない？ -->
<form class="login_form" action="http://localhost:8000/hello/auth" method="post">
    {{ csrf_field() }}
    @if(session('loginError'))
        <p>{{ session('loginError')}}</p>
    @endif
    <div>
        <label>email:</label>
        <input type="text" name="authEmail">
    </div>
    <div>
        <label>pass :</label>
        <input type="password" name="password">
    </div>
    <div>
        <input type="submit" value="ログイン">
    </div>
</form>
