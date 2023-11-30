<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
ルーティングの基本。第1引数はgetリクエストがどこに来た場合に処理を実行するか、第2引数にその処理を定義。
この場合、ルートにgetリクエストが来た場合に、welcomeというビューを返すことになる。
*/

Route::get('/', function () {
    return view('top');
})->name('reserve.top')->middleware('verified');


// Authファザードを扱う、またはログイン状態で扱う必要があるコントローラーのルーティング
Route::group(['middleware' => ['auth']], function() {
	Route::get('/get-reservation', 'ReserveController@formview')->name('reserve.form');
    Route::get('/reserve-index', 'ReserveController@index')->name('reserve.index');
	Route::post('get-reserve', 'ReserveController@searchReservation');
	Route::post('/reserve-confirm', 'ReserveController@confirm')->name('reserve.confirm');
	Route::post('/reserve-complete', 'ReserveController@store')->name('reserve.complete');
    Route::resource('reserve-delete', 'ReserveController',['only' => ['show', 'destroy']]);
});


// Route::post('/reserve-confirm', 'ReserveController@send');

// コントローラーを経由するルーティング、@以下は処理を振り分けるメソッド名を指定
Route::resource('carbon', 'CarbonController');

// ログイン認証に関するルーティング、基本的な設定なのでテスト段階は適宜コメントアウト等で処理。
Route::get('profile', function() {

})->middleware('verified');

Auth::routes(['verify' => true]);


Auth::routes();

// 管理者ログイン用のルーティング

Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/top'); });
    Route::get('login',     'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\Auth\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout',   'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::get('top',      'Admin\HomeController@index')->name('/admin/top');
});

// メール送信テストのルーティング。本実装のときはメール送信の発火元のように使う。

Route::get('/mail', 'TestMailController@send');

// ソーシャルログインのCallbackに関するルーティング。今回はGoogleのみ。

Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')->where('social','google');

// コールバックした結果を受け取るためのルーティング

Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->where('social','google');


