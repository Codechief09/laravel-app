<?php

namespace App\Http\Middleware;

use Closure;

class CheckLocale
{
     /** @var array 使用可能な言語*/
     private $langs = ['ja', 'en'];

     /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        // テストでは使用言語を英語で固定する
        // Dusk内では__()は使えない
        
        if (\App::environment('testing')) {
            \APP::setLocale('en');
            return $next($request);
        }

        $locale = '';
        if(isset($_GET['lang'])) {
            // GETパラメータから言語指定を取得する
            $locale = $_GET['lang'];
        }
        else {
            // セッションから言語指定を取得する
            $locale = session('locale');

            // セッションがなければ、ブラウザのAccept-Languageを参照する
            if (!$locale && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $locale = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
                $locale = substr($locale, 0, 2);
            }
        }

        // 指定された言語が$langsに存在しなければ、フォールバック用の用語を使う
        if (!in_array($locale, $this->langs, true)) {
            $locale = config('app.fallback_locale');
        }

        // 使用言語をセッションに保存する
        session(['locale'=>$locale]);
        \App::setLocale($locale);
        return $next($request);
        
    }
}
