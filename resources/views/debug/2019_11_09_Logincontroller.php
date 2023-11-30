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

        // 取得した認証結果のうち、メールアドレスをキーにしてテーブルに登録があるか確認する。
        $user = User::firstOrNew(['email' => $providerUser->getEmail()]);
        $password = User::where('password', $user)->first();
        
        // 上の条件に基づき、メールアドレスがあればそのままログイン、なければ認証情報からメールアドレスと名前を取得し、それをセッションに保存し、登録ページにリダイレクトし、セッションに保存された情報をフォームにオートコンプリートして、パスワードを設定させる。
        if ($user && isset($password)) {
            Auth::login(User::firstOrCreate([
                'email' => $providerUser->getEmail()
            ],[
                'name' => $providerUser->getName()
            ]));
            return redirect($this->redirectTo);

        } elseif($user && !isset($password)) {
            Auth::login(User::firstOrCreate([
                'email' => $providerUser->getEmail()
            ],[
                'name' => $providerUser->getName()
            ]));
            return redirect('/auth/confirmpassword');

        } else {
            return view('auth.register',['name' => $providerUser->getName(), 'email' => $providerUser->getEmail()]);
        }
    }
}
 