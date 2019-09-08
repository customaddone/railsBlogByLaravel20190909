<?php

namespace App\Http\Controllers;

use App\User;
/* バリデーションの為にRequestを使う時は書く */
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /* resourceルーティングがカバーする７つのアクションだけでコントローラーを実装できた　
    　 ふつくしい... */
    public function index(Request $request)
    {
        /* request->input('')でID値を取得する*/
        $keyword = $request->input('keyword');
        /* keywordが空で無ければ検索
           getSearchはUserモデルに書いています */
        if (!empty($keyword))
        {
            return view('users.index', [ 'items' => User::getSearch($keyword) ]);
        }
        /* 空であれば一覧 */
        $items = User::orderBy('number', 'asc')->get();
        return view('users.index', [ 'items' => $items ]);
    }

    public function show($id)
    {
        /* いくつかの項目はtranslateCharacterで分かりやすい形に変換した */
        $item = User::find($id);
        return view('users.show', array_merge([ 'item' =>  $item ],
                User::translateCharacter($item)));
    }

    public function create()
    {
        return view('users.new');
    }

    public function store(UsersRequest $request)
    {
        // まずUserクラスのインスタンス生成　バリデーションはHttp/Requestsにあります
        $item = new User;
        /* リクエストされた値を保管する値を用意します
        　　all()は全入力を「配列」として呼び出す値です */
        $form = $request->all();
        /* passwordはハッシュ化してください　
        　 でないとAuthで認証されません
        　 これに気づかずかなり時間を無駄にしました */
        $form['password'] = Hash::make($request->password);
        // トークンの値は使わないので除外します
        unset($form['_token']);
        /* 先ほと生成したインスタンスに値を設定して保存します
        　　直接$person->id = $request->id とすることも出来ます */
        $item->fill($form)->save();
        return redirect('/users');
    }

    public function edit($id)
    {
        $item = User::find($id);
        return view('users.edit', [ 'item' => $item ] );
    }

    public function update(UsersRequest $request)
    {
        $user = User::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $user->fill($form)->save();
        return redirect('/users');
    }

    public function destroy($id)
    {
        $item = User::find($id)->delete();
        return redirect('/users');
    }

}
