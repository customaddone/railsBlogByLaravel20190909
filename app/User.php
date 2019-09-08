<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /* 入力のガードを設定しておくもの
       モデルを作成する際にid値は入力の必要ないので、値なしでもいいようにする */
    protected $guarded = array('id');

    protected $fillable = [
        'number', 'name', 'full_name', 'email', 'birthday', 'sex', 'password', 'administrator',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* 検索用アクション */
    public static function getSearch($request)
    {
        $items = User::where('name', 'like',  '%' . $request . "%")
            ->orWhere('full_name', 'like',  '%' . $request . '%')->get();
        return $items;
    }

    /* ビューで性別、誕生日、管理者権限を分かりやすい形で表記する為のものです */
    public static function translateCharacter($request)
    {
        // sex->$sexCharacter = というふうにオブジェクトのプロパティに値を入れる方法を取れないか？
        $sexCharacter = ($request->sex == 1) ? "男" : "女";
        $birthdayCharacter = date('Y年m月d日', strtotime($request->birthday));
        $administratorMark = ($request->administrator == true) ? "○" : "×";

        return [
          'sexCharacter' => $sexCharacter,
          'birthdayCharacter' => $birthdayCharacter,
          'administratorMark' => $administratorMark,
        ];
    }
}
