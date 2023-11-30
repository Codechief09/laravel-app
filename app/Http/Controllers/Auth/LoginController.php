<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB; // ← DBファサードをuse


// ソーシャルログインに関するライブラリ
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    // ログインしたあとはトップページにリダイレクトする。変更したらRedirectolfAuthentcated.phpを編集
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * OAuth認証先にリダイレクトする
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    
    public function redirectToProvider ($provider) {
        return Socialite::driver($provider)->redirect();
    }

     /**
     * OAuth認証の結果受け取り
     *
     * @param str $provider
     * @return \Illuminate\Http\Response
     */
    
    public function handleProviderCallback ($provider) {
        try {
            // 認証結果を受け取って変数に格納する。
            $providerUser = \Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('oauth_error', '予期しないエラーが発生しました');
        }

        // 取得した認証結果のうち、メールアドレスをキーにしてusersテーブルに登録があるか確認する。
        $email = User::firstOrNew(['email' => $providerUser->getEmail()]);
        
        // usersテーブルからメールアドレスをキーにしてパスワードのレコードを抽出する。
        $passwords = \App\User::pluck('password','email');
        foreach($passwords as $email => $password) {

        }

        // 抽出したレコード群のうち、取得した認証情報に含まれるメールアドレスがキーの値を代入する。
        $findData = isset($passwords[$providerUser->getEmail()]);

        /*認証情報から得たメールアドレスがテーブルに確認できるが、パスワードの登録が未完了の場合、直接登録完了とせず、取得した認証情報からメールアドレスと名前をセッションに保存し、リダイレクトした登録ページのフォームに、オートコンプリートして、パスワードを設定させ、それを持って登録完了、ログイン処理を行いリダイレクトする。
        それ以外はログインしてリダイレクト処理。
        */
        if ($email && !$findData) {
            
            return view('auth.register',['name' => $providerUser->getName(), 'email' => $providerUser->getEmail()]);

        } else {
        
            Auth::login(User::firstOrCreate([
                'email' => $providerUser->getEmail()
            ],[
                'name' => $providerUser->getName()
            ]));

            return redirect($this->redirectTo);



        }

    }
}
 