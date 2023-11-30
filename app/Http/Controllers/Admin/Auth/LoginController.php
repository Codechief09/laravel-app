<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Admin\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;

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
    
    // ログイン後のリダイレクト先
    protected $redirectTo = '/admin/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    // 使用するguardを指定
    protected function guard() {
        return \Auth::guard('admin');
    }

        public function showLoginForm() {
        return view('admin.login');
    }

    public function logout (Request $request) {
        $this->guard()->logout();
        
        $request->session()->invailddate();

        return $this->loggedOut($request) ? : redirect('/admin/login');
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
        $user = User::where(['email' => $providerUser->getEmail()])->first();

        // 上の条件に基づき、メールアドレスがあればそのままログイン、なければ認証情報からメールアドレスと名前を取得し、それをセッションに保存し、登録ページにリダイレクトし、セッションに保存された情報をフォームにオートコンプリートして、パスワードを設定させる。
        if ($user) {
            Auth::login(User::firstOrCreate([
                'email' => $email
            ],[
                'name' => $providerUser->getName()
            ]));
            
            return redirect($this->redirectTo);
        } else {

            return view('auth.register',['name' => $providerUser->getName(), 'email' => $providerUser->getEmail()]);
        }

    }
}
