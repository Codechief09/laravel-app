## 概要
未経験からエンジニアに就職するために作成した成果物の話になります。

## はじめに

私の略歴とこれまでどういう人生を生きてきたのかというのは[こちら](https://qiita.com/shitikakei/items/8fb3f4c96a2ad28890f9)の記事に書きましたので、興味がありましたらぜひ。
これまでの学習履歴についてはQiitaに随時まとめているのがありますのでよろしければそちらを御覧ください。

さて、ある程度LaravelについてAuth・ログイン・CRUD周りを軽く触れてからいよいよ成果物を作ろうと思って最初にみたのが[こちらの記事](https://qiita.com/RINYU_DRVO/items/6607a0aa7ca3294f8e47)であり、作成の手順等について参考にさせて頂いたのでこの記事もこちらを参考に書かせていただいております。


[実際の成果物](https://facility-reservation-demo.herokuapp.com)

[Github](https://github.com/shitikamiyako/laravel_app)

## 課題の選定

私はプログラミングスクール等には通っておらず、また出身も文系かつ演劇学専攻の大学なのでプログラミングについても全くの門外漢であったので、成果物を作る上でまずはじめに壁にあたったのは

**「何を作るべきなのかがわからない」**

ということでした。
完全オリジナルで何かを作るにはスキルも見識も何もかもが足りておらず、皆目検討もつかないですし、さりとてTwitterやSNSのクローンアプリは成果物として作るにはチュートリアルと手法が確立しすぎているものを感じました。
調べると、前述の記事の方のような基本的なCRUDを実装したアプリや別の方はRailsを使って簡単なメモアプリを作ったと色々ありましたが、結論としては
未経験者が背伸びをして完全なオリジナルアプリを作るよりもチュートリアルや勉強してきたことを昇華させたものを作り上げるのが良いだろういうことと学んでいたのがPHP(Laravel)だったので、前述の記事をある利用予約をもとにしたCRUDのWebアプリケーションを作ろうということになりました。

## 目的

・チュートリアルに頼らず、設計や手順を1から自分で考え、Laravelを用いたWebアプリケーション開発経験を積む
・フロント側(JavaScript含む)とサーバー側(Laravel・MarinaDB)双方に触れた開発を行うことでWebアプリの基本的な構成、動作を知る
・未経験者なので、就職の面接でせめてこういうことを勉強して、こういうものを作ってみましたということを最低限話せる程度の力をつける
・アプリケーション作成を通じて、自分の適性や今後どういう方向に行きたいのかを見定める

## 環境

####言語
	PHP7.2.0(Laravel 6.5.0)
    
####データベース
	MariaDB 10.4.8
    
####開発環境
	Windows10
	Laravel Homestead
    
####CSSフレームワーク
	Bootstrap 4.0
    
####本番環境
	Heroku


## 主な機能

今回は例として市の施設を想定して、市民に対して多目的ホールA・B、道場、レクリエーションルームを開放していてその利用のための申請(予約)をユーザーが行うということを想定して作成しています。
当然、私はWebアプリケーション制作は初めてですし、そもそも実際にどういうものがあるのか、どういう動作や処理を組み込まなきゃいけないのか等々わからないことだらけでしたので、

[東京都利用登録](https://yoyaku.sports.metro.tokyo.jp/web/html/takinou.htm)
[江東区テニスコート空き検索と予約](https://tennisfull.com/koutou/godaikameido.html?date=2019/12/3)

この2つのシステムを参考に自分ができる範囲で作ったものが今回の成果物になります。
故に最初に申し上げて起きますと出来としては未熟・かつ課題の多く残るになるものではあります。
どうか寛大な目でそして、忌憚なき意見やアドバイス、ご指摘等々いただけると幸いです。


####TOPページ

サンプルとしてのTOPページです。
今回はフロント部分、とくにHTMLとCSSの部分にあまり労力は割けられない（サーバー側で大変なことになるのは目に見えていたので）のでBootstrapで簡易的に用意しました。

デザインはLaravelでCRUDの勉強をしていた際に参考にさせていただいた、こちらのものを一部手直しをしています。
[Laravel 5.7で基本的なCRUDを作る](https://qiita.com/sutara79/items/ef30fcdfb7afcb2188ea)

ソーシャルログイン経由も含む初回の会員登録の際はEメール認証を求められ、認証を行ってない場合はTOPページにアクセスができないようになっています。
この処理の他に、一応ログインの有無でTOPページの記載が異なっており、ログインor会員登録がないと機能にアクセスはできないようにはしてあるのですがメール認証を入れてしまえばそれだけで事が足りる気もしています。

ヘッダーリンクはプルダウンになっていて言語の切り替えとログアウト・予約フォーム、予約の確認画面への遷移ができます。
よって、今回のWebアプリケーションは全ページにおいて日本語と英語（Google翻訳を頼りにしたなんちゃってではありますが）の言語切り替えができるようになっています。

ログイン周りはLaravelのmake:Auth機能から特に変更していません。

####ログイン機能

メールアドレスとパスワード、またはGoogleアカウントによるOAuth認証も可能です。
会員登録が未完了の場合でソーシャルログインを行った場合はメールアドレスと名前を保持したまま会員登録のフォームに遷移し、パスワードを入力させ会員登録を先に行わせる形でソーシャルログインが可能になります。

####予約機能

会員登録をしてログインを行うことでアクセスできます。
予約したい施設と利用したい日を選択すると、利用時間を選択するドロップダウンメニューが表示されます。
この時Ajax通信を非同期で行い、データベースからその日の予約情報の取得を試みてもしあった場合はそれを応じて、表示されたドロップダウンメニューの選択肢を束縛します。

例えば9～13時、15時～17時と予約が入っていた場合
利用開始時間から
09:00～12:00、15:00

利用終了時間から
13:00、16:00、17:00

と上記の時間が選択肢から除外されます。
また同様の条件で例えば

09:00～15:00

といった選択がなされた場合は無効な値としてフォームにリダイレクトするようにしています。
無効な値としては他に

10:00～10:00といった開始と終了で同じ値を取った場合と11:00～10:00といった開始時刻が終了時刻よりあとの場合を無効な値として検知するようにしています。

既存の予約情報と重複せず、かつ無効な値の選択でもなかった場合は確認画面へ遷移します。
確定したならば、予約番号を発行しそれを含めてフォームの情報をデータベースに登録、同時にメールで予約内容を通知して、確定画面へと遷移し予約番号とメッセージを表示します。
入力し直す場合はフォーム画面へリダイレクトします。


#### 予約の確認・取り消し

ログインしてるユーザーが申請した予約の一覧、及びその削除ができます。
削除ボタンを押すと1件の情報表示(showメソッド)となり、キャンセルボタンを押すと確認ダイアログが出てきます。戻るを押すと一覧ページに戻ります。

## 開発手順

#### 1.環境選定
私はまず、環境の選定から行いました。
これまで学習してきたのはPHPであり、そしてこれはフレームワークを使うための練習も兼ねているためフレームワークはLaravelを選択しました。
データベースに関してはそのままMySQLでもいいのですが、これを始めるまではXAMPP環境で学習していたのでその流れからMariaDBを選択しました。
また、仮想環境としてはLaravelが用意してくれているLaravel Homesteadに使いそうなものはあらかた揃っていることとそもそも慣れる意味もあり、これを選択しました。
私は本来はマカーなのですが一昨年MBP 2011が壊れた際にお金がなかったので自作でWindowsを組んでいるためこうなっています。
今年はMBP買い直して友人に教えてもらってMacにDocker環境を構築したいですね。

#### 2.要件定義
最低限実装しなければならない機能は

・ログイン(認証)、ソーシャルログイン
・予約機能(データベースの検索、取得、追加、削除)
・メール認証、通知機能

以上の3点。
これを実現するために必要なデータベース、およびViewを整備しつつ、予約機能の部分に関してはJavascriptのプラグイン及びAjax通信が必要になる。
ソーシャルログインについては実装のしやすさと汎用性を兼ねたGoogleのものを選定。
これはTwitter及びFacebookは個人情報の登録がAPIの利用に必須でありかつ前者は申請から利用までに審査があるため今回は外した。
正直にいうとTwitterはアカウントを複数管理しているので個人情報を登録したくないという都合があります。
#### 3.GUI設計
参考先ではデータベースを先に設計していたので、私も先にそちらから進めていたがGUIが変わればデータベースも変わって来る可能性に気づいたので、途中でGUIを決めてからデータベースを考えることに変更しました。
その時作った遷移図は以下の通りです。

![ワイヤーフレーム](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/428779/6448afc9-d66c-0ece-e37e-739670a5ad40.png)


#### 4.データベース(テーブル)設計
成果物は何を作ったらいいのだろうという初制作の上での壁を除くと、ここが初めての詰まりポイントでした。
チュートリアルしかこなしてこなかった私は自分でテーブル設計をしたことがなかったので、こういう機能を実装するにはどういうテーブルを設計するべきなのかという知識がまるでなかったのです。

しかし、ITパスポートを取る上で正規化の考え方は知っていたのでそれを元にあーでもないこーでもないとネットの海から情報を拾い集め、それらしいものは作ったもののどうにもリレーションの概念の理解が足りなかったのでteratailにおいて[このような質問](https://teratail.com/questions/225110)を投げたところまたも先人のエンジニアの方が丁寧に解説してくださったのでそれを元に最終的に以下のようなテーブルを設計しました。

最後にreserveテーブルにおいての施設の名称に関するデータの保持の仕方です。
私は基本的にfacilitiesテーブルに対して、子の関係となるreserveテーブルではリレーションで検索に用いるときに扱いやすくするために施設名ではなく、施設コードで施設を表現すればいいと思っていましたが、先述の通り最終的に予約の一覧のView作成するタイミングでうまい具合にSQL文が構築できず、結果jsonファイルに施設コードを施設名に翻訳するように記載して予約一覧での施設名を表現してしまいました。
これは、明らかな悪手です。施設の追加をやろうとしたときに更新を確認しなければならないところが増えてしまいます。
どちらがベターなのかはこの時点の私にはなんとも言えないのですが、もし仮にこのままのテーブル構築でいくならばSQL文を構築してControllerからViewにきちんと変数で渡す形にして表現できるようにならないといけないなと感じました。

最終的には下図のようにテーブルを設計しました。

![ER図.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/428779/fa1e9563-8be7-9033-49d6-f02282df9ec7.png)


#### 5.コーディング
以下コーディングの過程です。コード等は全部載せると大変なので抜粋しています。
細かいところは最後Githubのリンクを載せますので、お手数ですがそちらをご覧頂ければ幸いです。
##### 5.1 データベースの作成

ER図は先程出した通りです。
LaravelのMake:Authで用いているものは割愛させてもらいます。
Seedingに関しては最初は検証のたびに行っていたのですが、ローカルでの作業中は途中から「TablePlus」というアプリを使ってテーブルの内容を修正していました。
最終的に行ったMigrationは以下のとおりです。
<details><summary>Migration一覧</summary><div>

```php:userテーブル
		<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

```

```php:facilitiesテーブル
	<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class CreateFacilitiesTable extends Migration
	{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('facilities', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->string('facility_code',4)->unique();
	        $table->string('facility_name',191);
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	    Schema::dropIfExists('facilities');
	}
	}

```

```php:business_hoursテーブル
	<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class CreateBusinessHoursTable extends Migration
	{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('business_hours', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->string('facility_code',4);
	        $table->foreign('facility_code')->references('facility_code')->on('facilities'); //上に同じ
	        $table->time('open');
	        $table->time('close');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::dropIfExists('business_hours');
	}
	}
```

```php:reservesテーブル
	<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class CreateReservesTable extends Migration
	{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('reserves', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->unsignedBigInteger('user_id'); //外部キーとして参照させるのでunsigned
	        $table->string('facility_code',4);
	        $table->foreign('user_id')->references('id')->on('users'); //外部キー参照のための記述
	        $table->foreign('facility_code')->references('facility_code')->on('facilities'); //上に同じ
	        $table->datetime('start_time');
	        $table->datetime('end_time');
	        $table->string('reserve_number',191);
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::dropIfExists('reserves');
	}
	}
```

```php:FacilitiesTableSeeder.php
<?php


use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // 外部キー制約無視
        App\Facility::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        // テーブルの初期化
        DB::table('facilities')->truncate();

        $facilities = [

            ['facility_code' => 'A001',
            'facility_name' => '多目的ホールA'],
            ['facility_code' => 'A002',
            'facility_name' => '多目的ホールB'],
            ['facility_code' => 'A003',
            'facility_name' => '道場'],
            ['facility_code' => 'A004',
            'facility_name' => 'レクリエーションルーム']
        ];

        foreach ($facilities as $key => $facility) {
            App\Facility::create($facility);
        }

        // 外部キー制約を有効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        App\Facility::reguard();

    }
}

```
</div></details>

##### 5.2 基本機能の整備
ログイン・ソーシャルログイン・パスワードリセット・多言語対応（日⇔英)・メール認証、通知機能といったサービスを利用するために必要な機能を整備しました。
特別なことは何もしていませんが、私は今回Laravel6でアプリを制作したのでログイン機能の実装の仕方が6以前と6では違ったのでメモしておいたものを一応書き残しておきます。

<details><summary>メモ</summary><div>
`php artisan make:auth` について

Laravel6.0からはやり方が違う。
まず、Laravelパッケージが入っているディレクトリでコマンドを実行する。
このときHomesteadにLaravelを入れている場合でもvagrantの仮想環境下で実行せずに、必ずPC側で実行する。
vagrant下で実行するとエラーを吐かれる。

実行するのは以下のコマンド。

```
composer require laravel/ui --dev

php artisan ui vue --auth

// Javascriptライブラリ及びBootstrapのインストールとコンパイル。
npm install && npm run dev


```
</div></details>
ちなみにこのnpmとvueに関しては後にLaravelでJavascript及びCSSを適用させるにはどうしたらいいのかということで大いに躓くことになるのですがそれはあとのお話で。
npmに関してはインストールには使ってましたが、逆に言うとそれしかやったことがなかったのですよね……

多言語設定に関してはLaravelのresourceフォルダ階下にあるlangフォルダを用います。
デフォルトで認証やバリデーション周りの翻訳ファイルが入っていますが独自に設定したい場合は以下のようにjsonを作ってViewにおいて

`{{ __('変換する言語') }}`

このような形記載すると実装できます。
翻訳される文字:翻訳した文字といった関係で書いていきます。
基本的には英語をViewに記載して、日本語に変換するというやり方で大丈夫ですが先述の通り私は少し力押しのような形でも使用してしまっているので以下のような形で作っています。

<details><summary>JSONファイル</summary><div>

```json:en.json
{
"多目的ホールA": "Multipurpose Hall A",
"多目的ホールB": "Multipurpose Hall B",
"道場": "Dojo",
"レクリエーションルーム": "Recreation Room",
 "A001": "Multipurpose Hall A",
 "A002": "Multipurpose Hall B",
 "A003": "Dojo",
 "A004": "Recreation Room"
}
```

```json:ja.json
{

    "This is my first web application for applying for a facility reservation.": "これは私が初めて制作したWebアプリで、施設の予約申請に用いることを想定しています。",
    "Feature": "機能",
    "All visitors can sign up. OAuth authentication with Google account is also possible.": "訪問者は会員登録ができます。GoogleアカウントによるOAuth認証も可能です。",
    "Each the logged in user can reserve facilities, confirm reservation and delete.": "会員は施設の予約、予約の確認、予約の取り消しを行えます。",
    "Admin": "管理者",


    "Delete": "削除",
    "Edit": "編集",
    "Create": "新規作成",
    "Submit": "送信",


    "Y-m-d H:i:s": "Y年m月d日 H:i:s",

    "Posted new article.": "記事を投稿しました。",
    "Updated an article.": "記事を更新しました。",
    "Deleted an article.": "記事を削除しました。",


    "Created new user.": "ユーザーを追加しました。",
    "Updated a user.": "ユーザー情報を更新しました。",
    "Deleted a user.": "ユーザーを削除しました。",


    "Confirm delete": "削除の確認",
    "Cancel": "キャンセルする",
    "Are you sure to delete?": "本当に削除してもよろしいですか?",


    "Users": "ユーザー",
    "User": "ユーザー",
    "Profile": "プロフィール",
    "Name": "ユーザー名",
    "E-Mail Address": "メールアドレス",
    "Password": "パスワード",
    "Confirm Password": "パスワード (確認用)",


    "Send Password Reset Link": "パスワード再設定用のリンクを送る",
    "Reset Password": "パスワード再設定",
    "Click link below and reset password.": "下記のURLにアクセスして、パスワードを再設定してください。",
    "If you did not request a password reset, no further action is required.": "このメールに心当たりがない場合は、このまま削除してください。",


    "New Post": "投稿する",
    "Login": "ログイン",
    "Login With": "ソーシャルログイン",
    "Logout": "ログアウト",
    "Register": "ユーザー登録",
    "Register With": "ソーシャルアカウントで登録する",
    "Remember Me": "ログインしたままにする",
    "Forgot Your Password?": "パスワードをお忘れですか?",


    "You logged in.": "ログインしました。",
    "You logged out.": "ログアウトしました。",
    "Registration have not yet completed.": "登録はまだ完了していません。",
    "Check your email for a verification link.": "確認用に送信したメールの記載に従って、登録手続きを完了してください。",
    "Registration completed.": "ユーザー登録が完了しました。",


    "Error": "エラー",
    "Forbidden": "閲覧禁止",
    "You do not have permission to access this page.": "このページを表示する権限がありません。",
    "Not Found": "ページが見つかりません",
    "The requested page does not exist.": "リクエストされたページは存在しません。",
    "Internal Server Error": "サーバ内部エラー",
    "The server was unable to complete your request.": "サーバが処理を完了できませんでした。",


    "Verify Your Email Address": "ユーザー登録を完了してください",
    "A fresh verification link has been sent to your email address.": "ユーザー登録の確認用のメールを送信しました。",
    "Before proceeding, please check your email for a verification link.": "メールに記載されているリンクをクリックして、登録手続きを完了してください。",
    "If you did not receive the email,": "メールが届いていなければ、",
    "click here to request another.": "こちらをクリックして再送信してください。",
    "Please click the link below to verify your email address.": "下記のリンクをクリックして、このメールアドレスでユーザー登録することを確認してください。",
    "If you did not create an account, no further action is required.": "ユーザー登録に心当たりがない場合は、このまま削除してください。",
    "Verify Email Address": "このアドレスで登録する",
    "Reserve Form": "予約申請フォーム",
    "Facility Name": "利用する施設",
    "Date": "利用日",
    "Start Time": "利用開始時刻",
    "End Time": "利用終了時刻",
    "Delete Reservation": "予約の取り消し",
    "Your Reservation Index": "予約状況の一覧",
    "Are you sure you want to cancel this reservation?": "本当にこの予約を取り消しますか？",
    "Are you really sure?": "本当によろしいですか？",
    "Submit": "決定",
    "Yes": "キャンセルする",
    "Sure": "はい",
    "Close": "閉じる",
    "Back": "戻る",
    "Back to Top": "Topに戻る",
    "Confirm a reservation": "予約を決定する",
    "Back to Form": "入力内容を変更する",
    "Please Select": "選択してください",
    "Multipurpose Hall A": "多目的ホールA",
    "Multipurpose Hall B": "多目的ホールB",
    "Dojo": "道場",
    "Recreation Room": "レクリエーションルーム",
    "Member registration or login is required to use this site.": "このサイトを利用するには、会員登録またはログインが必要です。",
    "Sample Function": "機能テスト",
    "Reserve": "予約を行う",
    "Confirm Reservation": "予約を確認する",
    "Confirm Reservation and Delete Reservation": "予約を確認、または予約の取り消しを行う。",
    "Cancel your reservation": "予約のキャンセルする",
    "The selected time is already reserved or invalid.": "選択された時間はすでにご予約があるか無効な選択です。",
    "The selected date is invaild.": "選択された日付は無効な日付です",
    "Your reservation is complete.": "予約が完了しました。",
    "Please note the following reservation number, as it will be required for inquiry.": "以下の予約番号はお問い合わせの際に必要になりますのでお控えください。",
    "Reservation Number": "予約番号",
    "Are your selections as follows?": "以下の内容でお間違いはないですか？",
    "A001": "多目的ホールA",
    "A002": "多目的ホールB",
    "A003": "道場",
    "A004": "レクリエーションルーム"
}
```
</div></details>
また、多言語化は全ページで行いたいのでMiddlewareを作りました。
メールに関しては会員登録の際にメール認証を行うことで本登録としたいのでmake:authで用意したものを整備しています。
予約内容のメール通知に関してはMailフォルダに以下のクラスを作って実装しています。

<details><summary>ContactSendmail.php</summary><div>

```php:ContactSendmail.php

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $facility_name;
    private $dateinfo;
    private $start_time;
    private $end_time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs) {

        $this->facility_name = $inputs['facility_name'];
        $this->dateinfo = $inputs['dateinfo'];
        $this->start_time = $inputs['start_time'];
        $this->end_time = $inputs['end_time'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this
            ->from('example@test.com')
            ->subject('利用予約確定のお知らせ')
            ->view('contact.mail')
            ->with([
                'facility_name' => $this->facility_name,
                'dateinfo' => $this->dateinfo,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
            ]);
    }
}
````
</div></details>

会員登録とログイン周りはデフォルトのmake:authからは特に大きな変更はありませんがGoogleアカウントによるソーシャルログインとパスワードリセットは実装してあります。
また、先述の通りメール認証していない場合はTOPページにアクセスできず、ログイン・会員登録画面にリダイレクトされます。

LoginControllerは以下のように整備

<details><summary>ContactSendmail.php</summary><div>

```php:LoginController.php

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
```
</div></details>

##### 5.3 予約機能の整備
	
私の知識が間違っていなければ要件定義における機能要件にあたる部分の実装を行います。
設計の段階で仮に作っておいた先述のワイヤーフレームを元にまず縦の流れを順に作業しました。
実際作ったものとこのワイヤーフレームとは結果として多少異なりますが、アプリを作る上で


**・画面はいくつ必要なのか？**
**・画面遷移は何回やるのか？**
**・何を表示させるのか？**
**・ページごとの処理、ページ間の処理は何があるのか？**


等々を考える上で図にまとめるのはほぼ必須の工程だと思っていたので仮にでもワイヤーフレームと遷移図(処理図)は作成しておくのをおすすめします。

好みにもよるかもしれませんが、個人的には

**・簡易的なViewを作る**
**・ControllerとModelに手を入れる（処理を書いていく)**
**・テスト**
**・ひとまずつつがなくいったら次のViewへ**

といった感じで行くのがいいと思いました。

いざやってみると思っていたよりかなりやることなすこと初めてのことばかりでしたので1つのメソッドを書くのに幾多のエラーを出し、結果数多の時間を費やすことになりました。
ここまではソーシャルログインと多言語対応を除けばLaravelの基本機能でしたが、ここから自分で1から考える工程なのでLaravelで初めて作られる方にとっては壁になりやすいところです。私も、何度心が折れそうになったかわかりません……頑張りましょう。
MVCを意識するべきということを学習の過程で何度も見たのですが、では実際どうするべきなのかというのは意見が割と分かれている印象を受けたのですが、私は[こちら](http://rabbitfoot141.hatenablog.com/entry/2018/10/16/194555)を参考に

>>HTTP に関する処理を Controller でのみ扱い、 Model に含めない

ということだけは一応最低限意識してControllerとModelを書いたつもりです。
具体的にはテーブルから情報を引っ張ってくる処理はModelに、HTTPに関する処理はControllerにということを意識しました。
苦労したところは

**・フォームの情報をもとにリレーション先のテーブルの情報を検索して取得する処理(wherehasの処理)**
**・データベースから取得したレコードの返り値の問題(メソッドによる返り値の違い)**
**・データベースから取得したレコードの整形(カラムごとに配列にしたりなど)**
**・日付時刻の扱い(加工する場合はインスタンスの状態だが実際に値として格納するなら文字列)**
**・日付・時刻比較**
**・フォームのボタンによる処理の区別**

一番最後に関してはLaravel側で区別してるパターンとJavascriptで区別させてるパターンの2パターンで実装しています。
統一した方がいいのか？ と悩みましたが、練習の意味合いと後者はAjax発火とFORM全体のPOSTの区別なのでJavascript側で判断させたほうがいいかな？と思って2パターンで実装しています。

特に時刻に関して想像以上に扱いが難しく、例えば13:00~15:00は09:00~17:00の間に含まれているのかといったような時間帯の比較ができるものだと思っていたのがそういった直接的なやり方ができなかったのは衝撃で、実装する機能の関係上ダブルブッキングの排除は必須ですので無視するわけにもいかず、おそらく今回の作業の中で1番頭を悩ませたところでした。
結果として、後述するJavascriptの部分で先にこの問題にぶち当たり、にっちもさっちもいかなくなってteratailで質問したところ、丁寧な回答を幸いにも頂けたのでそれをもとに考えて書きましたが、ベターなのかと言われるとかなり自身がないです。
もし現役の方がいらっしゃいましたこの辺りの処理についてコメント欄でアドバイスいただけると幸いです。


戒めの意味を込めた余談ですが、基本中の基本の話としてメソッドに引数を設定した場合、呼び出し先やメソッド内の処理で用いる関数に必ずその引数を設定することをお忘れなく。私は混乱の末それをすっかり忘れてteratailで質問して、回答者の方にて諭されました(1敗)。
大反省です。

主たる役割を果たしているReserveControllerは以下の通り。

<details><summary>ReserveController</summary><div>

```php:ReserveController.php
	<?php

namespace App\Http\Controllers;

use App\Reserve;
use App\Facility;
use App\Exceptions\ReserveDuplicationException;
use App\Exceptions\DateException;
use App\Http\Requests\CreateReserveRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactSendmail;


class ReserveController extends Controller {

    // フォームから受け取った情報をもとにテーブルを検索、施設名から施設IDを引っ張り、日付と合わせて予約情報を取得しAjaxに返す。
    public function searchReservation(Request $request) {

        $data = $request->all();

        if(isset($data['dateinfo']) && isset($data['facility_name'])) {

        $dateinfo = $data['dateinfo'];
        $facility_name = $data['facility_name'];

        $reserveinfo = Reserve::SearchReserveDates($facility_name, $dateinfo);

        \Debugbar::info();

        return json_encode($reserveinfo, JSON_PRETTY_PRINT);

        } else {
       echo 'FAIL TO AJAX REQUEST';
    }
}

    // 入力確認画面に最終的なフォームの値を渡す。Requestにはバリデーションの拡張クラスを渡す。
    public function confirm(CreateReserveRequest $request) {
        
        // 予約情報取得

        $data = $request->all();

        if(isset($data['dateinfo']) && isset($data['facility_name'])) {

        $dateinfo = $data['dateinfo'];
        $facility_name = $data['facility_name'];
        $now = Carbon::now()->toDateString();;

        if($dateinfo < $now) {
            throw new DateException;
        } else {

            $reserveinfo = Reserve::SearchReserveDates($facility_name, $dateinfo);
        }
    }


        // 取得したレコードを配列の形にする。
        // start_timeとend_timeそれぞれの値で配列を作る。
        
        $arr_start_time = array_column($reserveinfo, 'start_time');
        // var_dump($arr_start_time);
        $arr_end_time = array_column($reserveinfo, 'end_time');
        // var_dump($arr_end_time);

         // 選択された時間帯が予約時間と重複していないか検証
        if(isset($data['start_time']) && isset($data['end_time'])) {
           
        // datetime型に整形
        $start_datetime =$data['dateinfo'] .' '. $data['start_time'];
        $end_datetime =$data['dateinfo'] .' '. $data['end_time'];

        // Carbonに整形
        
        $st = new Carbon($start_datetime);
        $start = $st->format('Y-m-d H:i:s');
        // var_dump($start);
        $ed = new Carbon($end_datetime);
        $end = $ed->format('Y-m-d H:i:s');
        // var_dump($end);
        // テーブルから予約情報取得して配列に格納
        // それぞれ$arr_start_time[]と＄arr_end_times[]で呼び出せるようにする
        // forかwhile文で$start_time[n]と$end_time[n]まで検証する
        
        // $arr_start_time及び$arr_end_timeの配列の数を取得する。
        $c1 = count($arr_start_time);
        $c2 = count($arr_end_time);

        
        // 時間帯比較の関数
        function isTimeDuplication($start, $end, $start_time, $end_time) {
            return ($start < $end_time && $start_time < $end);
        }

        // 入力値が同値または利用開始時間が終了時間より大きい場合はエラー
        if ($start === $end || $start > $end) {
            throw new ReserveDuplicationException;
        }

        // try-catchで時間帯比較をし、例外が出たら入力フォームまでロールバックする。
        
        try {

            for ($i=0; $i < $c1 && $c2 ; $i++) {

            $start_time = $arr_start_time[$i];
            $end_time = $arr_end_time[$i];

            $result = isTimeDuplication($start, $end, $start_time, $end_time);

                if($result === TRUE) {
                    throw new ReserveDuplicationException;
                }
            }

            // 入力確認ページのviewにdataを渡す
            return view('reserve-confirm', [
                'data' => $data,
            ]);

        } catch(ReserveDuplicationException $e) {
            throw $e;
        }


    }
}

        // 予約完了メールの発送
        public function send(Request $request) {

            //フォームから受け取ったactionの値を取得
            $action = $request->input('action');
            $inputs = $request->except('action');

            $user = Auth::user();
            $email = $user->email;
            \Mail::to($email)->send(new ContactSendmail($inputs));

            // トークンを再発行して再送信防止
                
            $request->session()->regenerateToken();

        }

    public function formview() {
        return view('get-reservation');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        $user_id = $user->id;
        $reserves = Reserve::searchReservation($user_id);
        return view('reserve-index', compact('reserves'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReserveRequest $request) {

        
        // 再度ダブルブッキングのチェックを行う。
        $this->confirm($request);

        // 以下、ダブルブッキングなしの場合の更新処理

        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');
        // フォームからactionの値を取得
        $action = $request->input('action');

        //actionの値で分岐
        if($action !== 'submit'){
            return redirect()
                ->route('reserve.form');

            } else {

        // 検索用にfacility_nameをのみ別に変数に取り出しておく
        
        $facility_name = $inputs['facility_name'];

        // facility_idを抽出するメソッド
        
        $facility_code = Facility::SearchFacility_code($facility_name);


        // dateinfoとstart_time及びend_timeを組み合わせてdatetime型にする。
        $start_time =$inputs['dateinfo'] .' '. $inputs['start_time'];
        $end_time =$inputs['dateinfo'] .' '. $inputs['end_time'];

        // 予約番号生成
        
        $reserve_number =  uniqid(bin2hex(random_bytes((1))));

        // ユーザー情報取得
        $user = Auth::user();
        $user_id = $user->id;

        // データベースに追加
        $reserve = new Reserve();
        $reserve->user_id = $user_id;
        $reserve->facility_code = $facility_code;
        $reserve->start_time = $start_time;
        $reserve->end_time = $end_time;
        $reserve->reserve_number = $reserve_number;
        $reserve->save();

        \Debugbar::info();

        $this->send($request);

        // viewへ遷移
        return view('reserve-complete' ,[
                'reserve_number' => $reserve_number,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $reserve = Reserve::find($id);
        $facility_code = $reserve->facility_code;
        $facility_name = Facility::SearchFaciliy_name($facility_code);
        return view('reserve-delete', ['reserve' => $reserve , 'facility_name' => $facility_name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $reserve = Reserve::find($id);
        $reserve->delete();
        return redirect('reserve-index');
    }
}


```
</div></details>

<details><summary>Model</summary><div>

```php:Reserve.php

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Webpatser\Uuid\Uuid;
// use Katteba\UUID\UUIDShortener;

class Reserve extends Model {
	
	// テーブル名指定
	protected $table = 'reserves';

	// 以下の項目を無効
	const UPDATED_AT = null;
	const CREATED_AT = null;

	protected $fillable = [
		'user_id',
		'facility_code',
		'start_time',
		'end_time',

	];

	// protected static function boot () {
	// 	parent::boot();

	// 	static::creating(function ($model) {
	// 		$model->{$model->getKeyName()} = Uuid::generate()->string;
	// 	});
	// }

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function facility() {
		return $this->belongsTo('App\Facility', 'facility_code', 'facility_code');
	}

    static function SearchReserveDates($facility_name, $dateinfo) {

    	$result = self::whereHas('Facility', function($query) use($facility_name, $dateinfo) {
		$query
			->where('facility_name',$facility_name)
			->whereDate('start_time',$dateinfo)
			->whereDate('end_time',$dateinfo);
						})->select('id', 'start_time', 'end_time')->get()->all();
		return $result;
	}

	static function SearchReservation($user_id) {

		$result = self::where('user_id', $user_id)->get();

		return $result;

	}
}

```

```php:Facility.php

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model {
	
	protected $table = 'facilities';
	const UPDATED_AT = null;
	const CREATED_AT = null;

	public function reserves() {

		return $this->hasMany('App\Reserve', 'facility_code', 'facility_code');

	}
	
	public function business_hours() {
		
		return $this->hasMany('App\Business_hour', 'facility_code', 'facility_code');
	}

	static function SearchFacility_code($facility_name) {
		$results = self::where('facility_name', $facility_name)->select('facility_code')->get();
		foreach ($results as $result) {
			$result = $result->facility_code;
		}
		return $result;
	}

	static function SearchFaciliy_name($facility_code) {
		$results = self::where('facility_code', $facility_code)->select('facility_name')->get();
		foreach ($results as $result) {
			$result = $result->facility_name;
		}
		return $result;
	}
}

```
</div></details>

#####5.4. Viewの整備

あらかた処理に問題ないと感じたらViewを作っていきます。
LaravelはBladeテンプレートを使うので使い方をある程度学習しておくといいと思います。
私は見様見真似でやって最初かなり詰まりました。

考えた末今回は大元のviewを以下のように設定し、あとはコンテンツごとのViewを挿入する形にしましたが、理想はhead・footer、あとは必要によってはheader部分も別に分けるべきでしょう。
事実、Githubを見ていただければおわかりのとおりですが用意はしましたが、私の勉強不足で今回は上手いこと実装できませんでした。

初見だとややこしいこのBladeテンプレートですがメリットもあって今回私が感じたのはXSSとCSRF対策をほぼ勝手にやってくれるところです。
Bladeテンプレートで文字列を挿入するには{{ }}で囲まないといけないので自然とXSS対策になり、CSRFに関してはFormを扱う場合はそもそも@csrfを挿入しないとエラーが出ます。

<details><summary>Blade</summary><div>

```html:parent.php

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<title>test</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- flatpickr -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>

	<!-- moment.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
	<!-- Headタグ内に足す。Webpackによるcssの読み込み -->
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/original.css') }}">
</head>
<body>
	<div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        	<!-- Header Logo -->
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
				<!-- Navbar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar  -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <!-- ヘルパ関数を用いて引数で渡したコントローラー名のいずれかが現在のコントローラー名と一致すればactiveクラスを追加 -->
                        @guest
                            <li class="nav-item @if (my_is_current_controller('login', 'password')) active @endif">
                            <a class="nav-link" href="{{  route('login')  }}">
                                {{ __('Login') }} 
                                @if (my_is_current_controller('login', 'password')) 
                                <span class="sr-only">(current)</span> 
                                @endif</a>
                        </li>

                            @if (Route::has('register'))
                                <li class="nav-item @if (my_is_current_controller('register')) active @endif">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                    @if (my_is_current_controller('register'))
                                        <span class="sr-only">(current)</span>
                                    @endif
                                </a>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!-- onclickイベントでaタグをクリックした場合の画面遷移をキャンセルして#logout-formのformを実行する -->
                                    <a class="dropdown-item" href="{{ route('reserve.form') }}">
                                        {{ __('Reserve') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('reserve.index') }}">
                                        {{ __('Confirm Reservation') }}
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="dropdown-lang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('locale.'.App::getLocale()) }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-lang">
                                @if (!App::isLocale('en'))
                                    <a class="dropdown-item" href="{{ my_locale_url('en') }}">
                                        {{ __('locale.en') }}
                                    </a>
                                @endif
                                @if (!App::isLocale('ja'))
                                    <a class="dropdown-item" href="{{ my_locale_url('ja') }}">
                                        {{ __('locale.ja') }}
                                    </a>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="my-5">
            @yield('content')
        </main>
    </div>
<!-- holiday-jp これだけは直読みさせる（ブラウザ反映のため）-->
<script src="./js/holiday_jp.js"></script>
<!-- 独自に設定したjs -->
<script src=" {{ mix('js/original.js') }} "></script>
<!-- npmで入れているjs -->
<script src=" {{ mix('js/app.js') }} "></script>
</body>
</html>

```
</div></details>
5.5 JavascriptとCSSについて(npm・webpack・Laravel mix)
テーブル設計、時間比較に続く第3の壁がここでした。
まずLaravelでBladeテンプレートを使用する場合、JavascriptやCSSの適用を行うには少々手順を踏まないと行けないのです。
とはいっても、単に適用させるだけであればpublicフォルダのcssあるいはjsフォルダにファイルを置いて指定してやればいいのだが特にJavascriptをLaravelで使う場合はnpmを用いてインストールして使用することになるのでこれだけだとうまく行かない可能性があります。
実際私も後述のLaravel Mixを用いたWebpackの仕組みを使わないと上手くプラグインもCSSも機能しませんでした。

さてどうしたものかと調べていると、どうやらJavascriptは今やVueとnpmで廻っているらしく、また実際に書いたJavascriptやCSSファイルをWebで使用する際にはビルドし直して、コードを省略するWebpackなる仕組みもあり、Laravelにもそれを手助けするLaravel Mixという機能があることを知ったのでなんとか挑戦することにしました。
結論を言うとnpmでのプラグインの管理とLaravel MixによるWebpackの使用まではなんとかいけたものの、Vueを使うにはスキルも知識も足りず工数的に勉強する時間もなかったので断念することになりました。

Laravelでのnpmライブラリインストールとビルドは[こちら](http://skill-up-engineering.com/2017/11/23/npm%E3%81%A7%E3%81%AEjs%E3%83%A9%E3%82%A4%E3%83%96%E3%83%A9%E3%83%AA%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%AB/)を参考に行いましたが、それでも道中で詰まり続けたので公式のドキュメントとにらめっこしながらさらにググり続けてどうにかこのように実装しました。

必ず用意するものの役割を簡単に述べると

webpack
->ビルドするファイルとビルド先のファイルを定義している他Webpackの設定などを定義する。

app.js
->npmでインストールしたプラグインのうちどのプラグインを使うのかを定義する。

app.scss
->プラグインの中には使用するCSSが用意されているのでそれらの指定を行う。

ということになる。
自分で書いたjsやcssはwebpackでビルドするように指定しておく。
resouseフォルダに使用するjsやcss置いて、publicフォルダにビルドするといった形になる。
また、cssはscssというファイルで書かないといけない。
scssはcssの書き方をより省略したようなものなのだが、今回はBootstrapを使用しているのもあるのと失念していたのか普通のcssの書き方で書いてしまっている。

<details><summary>必須のファイル</summary><div>

```js:webpack
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the scss
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/original.js', 'public/js')
	.version()
	.scss('resources/scss/app.scss', 'public/css')
	.scss('resources/scss/original.scss', 'public/css');


if (mix.inProduction()) {
    mix.version();
  }
```

```js:app

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./jquery');

require('./bootstrap');

window.Vue = require('vue');
// holiday-jp
require('@holiday-jp/holiday_jp');
import * as holiday_jp from '@holiday-jp/holiday_jp';
// flatpickr
require('flatpickr');
// jQuery-datetimepicker
require('jquery-datetimepicker');
// moment
require('moment');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
```

```scss:app

// Fonts
@import url('https://fonts.googleapis.com/css?family=Nunito');

// Variables
@import 'variables';

// Bootstrap
@import '~bootstrap/scss/bootstrap';

// flatpickr
@import "../../node_modules/flatpickr/dist/themes/airbnb.css";

@import "../../node_modules/flatpickr/dist/plugins/monthSelect/style.css";

// Datetimepicker
@import "../../node_modules/jquery-datetimepicker/jquery.datetimepicker.css";
```
</div></details>

<details><summary>自分で用意したJSとCSS</summary><div>

```js:original

window.onload = function () {
  $(document).on("click", "#date-select", function () {
    init_set_reservations();
  }); // 1で発火したajaxでデータベースにアクセスして、テーブルから取得した日付の予約情報を取り出す。

  function init_set_reservations() {
    var server_url = "https://facility-reservation-demo.herokuapp.com/"; // 使用しているサーバーのURLを定義
    // フォームで送信されるデータの確認、本番ではコメントアウト。
    // var formData = $('#test').serialize();
    // console.log(formData);
    // Ajax。今回は非同期で行いたい。

    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF対策、Ajax使う場合はLaravel側と合わせてこの項目も記載する。

      },
      url: server_url + "/get-reserve",
      // datatype: 'json',
      data: {
        dateinfo: $('#dateinfo').val(),
        // 日付選択のためのinputタグからの情報
        facility_name: $('#facility_name').val() // 施設名選択のためのinputタグからの情報

      }
    }).done(function (data) {

      console.log(data);

      const testdata = JSON.parse(data);
      console.log(testdata);

      if (0 === Object.keys(testdata).length) {
       
        jQuery('#start_time').datetimepicker({
        datepicker:false,
        format:'H:i',
        minTime:'09:00',
        maxTime:'19:00',
        })

        jQuery('#end_time').datetimepicker({
        datepicker:false,
        format:'H:i',
        minTime:'10:00',
        maxTime:'20:00',
        })

      var classes = document.getElementsByClassName('js-timeselectform');

      for (i = 0; i < classes.length; i++) {
      if(classes[i].style.display ==="flex") {
        classes[i].style.display = "none";
      }else{
        classes[i].style.display = "flex";
      }
    }

    } else {
    // momentのフォーマット文字列を定数にしておく
      const FORMAT_DATE = "YYYY-MM-DD";
      const FORMAT_DATETIME = "YYYY-MM-DD HH:mm:ss";
      const FORMAT_TIME = "HH:mm:ss";

      // ジェネレータ(関数)を定義しておく
      // 今回はある時間とある時間の間にある日時を開始は含み、終了は含まないように1時間ごとに取得する。
      
      function* range({start, end}) { // 引数はstartとendプロパティを持つオブジェクトである。
        let m = start; // 変数にstartプロパティを設定する。
        while (m.isBefore(end)) { // 実行する関数を定義。momentのisBeforeメソッドを使って、mに設定したmomentプロパティをendと比較し続け、m<endである限り以下の処理を実行する。
          yield m; // 一度関数の処理を止めたあとmをreturnする。
          m = moment(m).add(1, 'hour'); // mに1時間加算する。whileまで戻る。
        }
      }


      // Ajaxで受け取ったJsonデータをパースする
      
      const reservedata = JSON.parse(data).map(e => ({
        start: moment(e.start_time, FORMAT_DATETIME),
        end: moment(e.end_time, FORMAT_DATETIME)
      }));

      console.log(reservedata);

      // 日付部分の文字列の取得
      
      const dateStr = reservedata[0].start.format(FORMAT_DATE);　// dataで得られた時間からその日の日付をだけ抜き出す。

      // 営業時間の定義。本来は営業時間テーブルから引っ張ってくるが今回は直接momentの値を持つオブジェクトとして定義する。
      
      const business_hours = {
        start: moment(`${dateStr} 09:00:00`, FORMAT_DATETIME),
        end: moment(`${dateStr} 19:00:00`, FORMAT_DATETIME)
      };
      // filterを用いて、営業時間帯に含まれる時間の中で選択可能な時間に適用ものだけを取得する
      
      const selecttablesStartMoments = [...range(business_hours)].filter(m => 
      // [...range()]はスプレット構文といい、iterableオブジェクトをこれで展開することができる。range関数はジェネレーターでジェネレーターはiterableであるのでこの表記で実行することができる。
      reservedata.every(e => m.isBefore(e.start) || m.isSameOrAfter(e.end)) // everyメソッドに与えられた引数の関数が配列すべてに適応されるかチェック。

      // つまり、filterで絞る条件はrangeで取得されていくmがdata.every()に適応されるかということになる。
      );

      const selectStarttime = selecttablesStartMoments.map(m => m.format(FORMAT_TIME)); // mapで新たにfilterの結果を配列にする。m.format()を実行するようにすることでmomentの値の配列にできる。

      console.log(selectStarttime);

      // 次に$end_timeのallowTimesに設定する時間帯を取得する
      
      function* range1({start, end}) { // 引数はstartとendプロパティを持つオブジェクトである。
        let m = start; // 変数にstartプロパティを設定する。
        while (m.isBefore(end)) { // 実行する関数を定義。momentのisBeforeメソッドを使って、mに設定したmomentプロパティをendと比較し続け、m<endである限り以下の処理を実行する。
          yield　m = moment(m).add(1, 'hour'); // rangeとは違い今度は開始を含みたくない。
        }
      }
      const selecttablesEndMoments = [...range1(business_hours)].filter(m =>
      reservedata.every(e => m.isSameOrBefore(e.start)|| m.isAfter(e.end))
      );
      const selectEndtime = selecttablesEndMoments.map(m => m.format(FORMAT_TIME));

      console.log(selectEndtime);

      var classes = document.getElementsByClassName('js-timeselectform');
      var i = 0;

      for (i = 0; i < classes.length; i++) {
      if(classes[i].style.display ==="flex") {
        classes[i].style.display = "none";
      }else{
        classes[i].style.display = "flex";
      }
    }

      // timepickerの設定を上書きする
      
      jQuery('#start_time').datetimepicker({
        datepicker:false,
        format:'H:i',
        allowTimes:selectStarttime
      })  

      jQuery('#end_time').datetimepicker({
        datepicker:false,
        format:'H:i',
        allowTimes:selectEndtime
      })

    }

    // }).fail(function (){
    
    });
  }

    $(document).on("click", "#date-select,#reserve-settle", function () {
    $(this).parents('form').attr('action', $(this).data('action'));
  }); // 

  // flatpickr
  
  // 祝日の取得、2年単位で取得する 
  const holidays = holiday_jp.between(new Date('2019-01-01'), new Date('2020-12-31'));
  var isArray = Array.isArray;

  function property (object, path) {
    if(object == null || typeof object != 'object') return;
    return(isArray(object)) ? object.map(createProcessFunction(path)) : createProcessFunction(path)(object);
    }

  function createProcessFunction(path) {
    if(typeof path == 'string') path = path.split('.');
    if(!isArray(path)) path = [path];

    return function (object) {
      var index = 0,
        length = path.length;
        while(index<length) {
          object = object[toString(path[index++])];
        }
        return(index && index == length) ? object : void 0;
    };
  }

  function toString(value) {
        if (value == null) return '';
        if (typeof value == 'string') return value;
        if (isArray(value)) return value.map(toString) + '';
        var result = value + '';
        return '0' == result && 1 / value == -(1 / 0) ? '-0' : result;
    }

  console.log(property(holidays, 'date'));
  console.log(holidays[0].date);
  var holidaysinfo = property(holidays, 'date');

  // 現在の日付のyearその翌年のyearを取得する
  const FORMAT_DATE = "YYYY-MM-DD";
  var currentyear　= moment().format('YYYY');
  var nextyear　= moment().add(1, 'year').format('YYYY');

  // 現在年とその翌年の指定休業日を定義する、祝日取得に合わせて2年分
  var regular_holiday = [
    moment(`${currentyear}-01-01`).format(FORMAT_DATE),
    moment(`${currentyear}-01-02`).format(FORMAT_DATE),
    moment(`${currentyear}-01-03`).format(FORMAT_DATE),
    moment(`${currentyear}-04-29`).format(FORMAT_DATE),
    moment(`${currentyear}-04-30`).format(FORMAT_DATE),
    moment(`${currentyear}-05-01`).format(FORMAT_DATE),
    moment(`${currentyear}-05-02`).format(FORMAT_DATE),
    moment(`${currentyear}-05-03`).format(FORMAT_DATE),
    moment(`${currentyear}-05-04`).format(FORMAT_DATE),
    moment(`${currentyear}-05-05`).format(FORMAT_DATE),
    moment(`${currentyear}-05-06`).format(FORMAT_DATE),
    moment(`${currentyear}-12-28`).format(FORMAT_DATE),
    moment(`${currentyear}-12-29`).format(FORMAT_DATE),
    moment(`${currentyear}-12-30`).format(FORMAT_DATE),
    moment(`${currentyear}-12-31`).format(FORMAT_DATE),
    moment(`${nextyear}-01-01`).format(FORMAT_DATE),
    moment(`${nextyear}-01-02`).format(FORMAT_DATE),
    moment(`${nextyear}-01-03`).format(FORMAT_DATE),
    moment(`${nextyear}-04-29`).format(FORMAT_DATE),
    moment(`${nextyear}-04-30`).format(FORMAT_DATE),
    moment(`${nextyear}-05-01`).format(FORMAT_DATE),
    moment(`${nextyear}-05-02`).format(FORMAT_DATE),
    moment(`${nextyear}-05-03`).format(FORMAT_DATE),
    moment(`${nextyear}-05-04`).format(FORMAT_DATE),
    moment(`${nextyear}-05-05`).format(FORMAT_DATE),
    moment(`${nextyear}-05-06`).format(FORMAT_DATE),
    moment(`${nextyear}-12-28`).format(FORMAT_DATE),
    moment(`${nextyear}-12-29`).format(FORMAT_DATE),
    moment(`${nextyear}-12-30`).format(FORMAT_DATE),
    moment(`${nextyear}-12-31`).format(FORMAT_DATE)
  ]

  console.log(regular_holiday);
  console.log(currentyear);

  // holiday.jpで取得した祝日の配列に指定休業日の配列を結合する
  var array_holiday = holidaysinfo.concat(regular_holiday); // 祝日の他に休業日を設定する

  console.log(array_holiday);

  var config = {
    // 祝日と指定休業日は選択できないようにする。
    disable: array_holiday
  }
  flatpickr(".dateinfo", config);

  // timepickerのデフォルト設定
  jQuery('#start_time').datetimepicker({
  datepicker:false,
  format:'H:i',
  minTime:'09:00',
  maxTime:'18:00',
  })

  jQuery('#end_time').datetimepicker({
  datepicker:false,
  format:'H:i',
  minTime:'10:00',
  maxTime:'19:00',
  })
}

```

```scss:original
.js-timeselectform {
  display: none;
}

.reserve-form {
	margin-top: 50px;
}

.card-title {
	text-align: center;
	margin-top: 20px;
	font-size: 20px;
}

.confirm-contents {
	line-height: 2.5;
}

.confirm-back {
	margin-bottom: 20px;
}

.back-top {
	text-align: center;
	margin-bottom: 20px;
}

#error-message{
	font-size: 18px;
	color: red;
}
```
</div></details>


##### 5.6 バリデーション
バリデーションに関しては今回はユーザーに自由記入させるフォームはログイン・会員登録周り以外ではないので予約フォームのものだけ簡単に用意した。


<details><summary></summary><div>

```php:CreateReserveRequest
	<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use App\Http\Requests\Request;

class CreateReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {

    // 認証関係のバリデーションはここ。なければtrueを返す。
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'facility_name' => 'not_in:0|string',
            'dateinfo' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ];
    }
}
```
</div></details>


#### 6 GithubとHerokuへのデプロイ
一通り動作を確認できたら本番環境へデプロイすることを考えます。
今までローカルな環境でしかやってこなかったのでここでもつまり、すべて終えるまで7時間くらいかかりました……

私が詰まった点としては今回はHerokuにデプロイしたので

・ローカルの環境変数を本番のそれに変更するための確認
->URLやデータベース、メール周り(ローカル環境ではMailtrapを使っていた)

・URL記述の変更とAPIを使っているのなら本番環境のリダイレクトURLを設定しなければならない。
->私はJavascriptの変数にルートアドレスを記述していたのと、ソーシャルログインでGoogleのAPIを使っていたのでこれを確認しなければならなかったのですが、うっかり失念して2時間位あーだこーだとやってしまいました……

・Herokuの場合任意のデータベースを使用したいのならアドオンを探さなきゃならない
->MariaDBを使いたかったのでそれを探しました。Heroku周りは全部英語なので英語がろくにできない私はなかなか大変でした。

。そもそもpushもデプロイも初めてなので仕様がよくわかってなかった
->実際に作業していたフォルダはそのまま残して置きたかったので、最初はそれをコピーしたものをpushしたのだが適当な場所においてしまったので余計なものまでpushしてしまいました。
イメージしたローカルに置いてあるフォルダを直接指定してそれをクラウドストレージに保存して同期させる感じ（ただし、更新の同期と適用はコマンドを実行しないと行われない)なので、そのあたりは注意しないといけませんね。


## 今後の課題や反省点、改良点など

年末年始に2人退職し、さらに1人新規採用した人が突如として電話口怒鳴り散らして辞めていったため多忙を極めてしまい、ちょうど体調もそこで一気に崩した影響と、そもそも粗を探して潰していったら今の私では現状時間がいくらあっても足らないので一応この時点で完成とし、ピリオドを打ちました。

故に課題や反省は山のようにあるのですが製作中、および制作して動かしてる際に見つかったことのうち特に気になることをリストアップしていきます。

#### テーブル設計

今回の制作にあたって未熟故に最初にぶち当たった壁でもあり、同時に未熟な点が機能部分のコードに並ぶくらい表れてしまった点だと思っています。

まず、営業時間テーブルを作ったのにも関わらずそれを活用していない点。
これはJavascriptでの時間判定の部分でかなり苦しめられたのと、すでに日付と施設の選択をキーにAjaxを用いているので、さらにそこからAjaxを増やすのか……？ とパンクしてしまったので今回はJavascriptの処理の中に定数として営業時間を定義するという形にしました。
しかし、これも更新性・可読性の点からよろしくないですし、何よりスマートではないです。メンテナンスとかデバックがすごい大変になりますしね……。

次に日付時刻の扱いです。
先程のER図を見ていただければおわかりの通り、予約情報の時間の保持のやり方として利用時間の最初と最後をのみを保持するという形でテーブルを設計しています。
しかし、このやり方は恐らく悪手なのだろうということは作中に大いに感じました。
と、いうのも時間帯を検索するということをコンパイルするのは非常に難しかった上に、先述の通りJavascriptにおいてteratailで質問したものを元に、Laravel側でも実装はできましたが、結果としてはかなり冗長かつスマートな処理とはお世辞にも言えないものになってしまいました。
これに関しては、大方書き終わりエラーハンドリングについて深夜に煮詰まって混乱しながら質問してしまった[こちらの質問](https://teratail.com/questions/233612)において解答者の方がより適切なやり方を提示してくださっています。
時間帯を1時間刻みのタイムスタンプで保持しておけば、ダブルブッキングを判定しやすいというのはなるほどと思いました。
また、友人には営業時間をテーブルに持たせるということの他に休業日はテーブルに管理しなくてもいいのかという指摘を受けました。
営業時間の方は先述の通り持たせるのがベターだと思います。
休業日に関しては今回はFlatpickrで休業日はブランクにする仕様にしたかったのと、これも先述の通りJavascriptとPHPとのやり取りをそこまで複雑にしたくなかったのもあり、そこで解決をすればいいのかなと思い今回はJavascriptに直接定義しています。
が、結局同じくプラグインを用いて管理している祝日を含めて2年単位の情報しか与えていない(ex. 2020~2021年分の休業日しかカレンダーに反映していない)ので、Javascriptに慣れたらここは再考しなければいけないなと思います。


#### バリデーション

バリデーションをデフォルトのものではなく、パスワード周りとかはカスタマイズしてもいいかもしれません。
また、公的なシステムでの利用を考えるならまた別ですが、一般的な会員登録サイトではユーザー登録自体は氏名で行い、実際にサイトで用いるユーザー名はハンドルネームのようなものを使う場合がほとんどなのでテーブル設計の際にそこを失念したのは反省です。
同時に公的なシステムで使用する場合は氏名を用いるのでバリデーションで漢字以外は弾かないといけませんね、それと同時に氏名でフォームは別にしないと……


#### 予約機能

このWebアプリケーションの機能としては根本の部分ですがそれ故に1番苦労したところであり、かつコーディングとしても処理としても機能としてもまだまだ未熟さが現れている部分となりました。
まず、フォームの部分ですが、当初は日付と施設を選択したら当日のタイムスケジュールを表示し、1時間ごとのブロック単位で選択できるようなフォームにし、選択をまとめてPOSTすることで時間帯の表現をしようとしたのですが、Javascriptは殆ど基本の部分しか触っていなかったので早々に断念。方針を改めて、苦肉の策としてFlatPickr及びjQueryDateTimePickerのプラグインを使ってこのような形で表現することになりました。
しかし、これではまずどの時間にすでに予約が入っているのかがわかりにくく、さらに上記の無効な値の件を見ていただければおわかりの通りそもそも、10:00～10:00や11:00～10:00といった選択ができてしまうという問題があります。
これはユーザビリティの点からはかなり良くない点になるので、うまい具合に落とし込むこともやりきれなかったのは今回1番悔いが残るところです。
前者に関してはメッセージとして予約情報を載せることは当然できますが、やはりスマートな解決とは言えないので今回はダメな点としてそのままにしています。


また、ここでさらに誤算として時間選択のバインドはプラグインの方で処理しなければならず(当たり前ですが、Javascriptはフロントエンドの言語なのでこれは当然のこと)、JavaScriptにおいてのオブジェクトと配列の扱いがド素人であったことと、日付時刻の扱いの難しさに私はここで一度詰まってしまいました。
どうにもならなくなってしまったので[このような質問](https://teratail.com/questions/230185])をteratailに投げたところ、幸いにも優しい先人の方が私の拙い文章やコードからやりたいことを汲み取ってくださり丁寧に解説してくださったので今回作り上げたところまではなんとか機能として実装することができました。
このご時世Javascriptからは逃げられないのだなということを強く実感しました。

入力内容変更の部分においては、フォームの内容を保持した方がいいのでは？という指摘を友人からも受けて検討しましたが、フォームにAjax非同期挙動を盛り込んでいることを考えると詰まりそうな予感がしたので今回は断念しています。
また、その関係で例えば日付と施設の変更をやり直したいといった場合はこの仕様だとページのリロードを行うか、日付・施設選択部分のボタンを2度押し直さないといけません。
ここはせめて、日付・施設の選択をやり直すといったボタンにページのリロードの挙動を仕込んだものを用意しておくべきだと作り終わってから気づきました。

コーディングの部分に関して個人的にダメだなと思うのは予約情報を取得してくる処理を複数のメソッドに使いたいのにメソッドにまとめていないところです。
searchReservationメソッドとしてあるのにAjax関連の処理と一緒に書いてしまっているのはよろしくないということに気づいたのは記事を書いている最中でした。
ここは処理を分けて、Ajax関連の処理のメソッドの中で$this->sendReservation()の形で使うべきでした。
書いている最中は煮詰まっていてパンクしていたのと、Request関数とそれに用いる引数を渡さなければいけないのでそのあたりで混乱していたのかもしれません。

またスキルが足りなかった故の課題としては、一応ユーザーの選択が一通り終わって確認画面へ遷移する際、try-catchで例外を投げる形にはしているが、トランザクションをきちんと整備しているとはいえないところもマイナスだと思いました。
pythonエンジニアのフォロワーさんに指摘されたのですが、今回のシステムの場合、確定処理には特にノンリピータブルリード（ファジーリード）がつきものなので本来ならこれを考慮した処理を書かなければいけないそうです。
トランザクションに関しては軽くどういうものなのかということと基本的なコードは学習していたのですが、応用ができなかったことになり大いに反省です。
また、解決できなかった不具合として予約が入っている日付に対して、当該時間に重複がないのに開始時間で18時が終了時間で19時がブランクになり選択できなくなる場合があります。
console.logの結果を見る限り、データの取得自体は問題なく、またjQuerytimepickerはブランクではなくそもそも選択肢に存在しなくなることで、選択できないようにする仕組みであったはずなのですが一体なぜなのか……

あとは、根本的なアルゴリズムを組む・考える力の足りなさも実感しましたね……機械語にコンパイルするの難しい。

#### 予約の確認・取り消し

利用する施設の部分は多言語化の対応をしていますが、埋め込みの部分でどうしてもviewにテーブルから引っ張ってきた施設名を上手いこと渡せずに止む無く、施設コードをja.json及びen.jsonで変換して表記しています。
これは、メンテナンス・更新性の観点からみると悪手で、施設テーブルで施設の情報を管理している以上そこから持ってきたものを適用するべきでしょう。
原因はテーブル設計の部分で触れる課題ですが、テーブル設計が甘く、予約情報を管理しているテーブルにおいて施設は施設コードとして表現しているためです。

#### 予約機能に関するView

エンジニアの友人に指摘されたところです。
工数の都合とタイムテーブルでの表現の仕方がどうにもわからなかったので省いてしまっているのですが、実際の使用を考えるなら選択した日付に入っている予約情報を表示しなければいけません。
理想はさておき、最低でもフォーム画面でAjax発火した際に文字列で表示するか、予約フォームの前半の部分を流用してユーザー個人のだけではなく、すべての予約の状況を確認できるようなページを作るかはしなければいけないなと感じました。

#### Bladeテンプレート

当該項目で触れたこととは別に、今回大本のBladeにjsとcssファイルの読み込みを指定していますが本来ならば使用するViewごとに指定するようにしなければなりません。
この辺りはfooterとして分けておかなければいけなかったですね	……

#### セキュリティ周り
Laravelを使っているのでXSSとCSRFに対してまるっきり無防備というわけではないのですが、セキュリティ周りの知識についてはまだまだ学びが足りてないので過信してはいけないなと感じています。
特にバリデーションが今回厳格ではないので、実際に使用することを考えた場合は改めて見直しが必要でしょう。

## あとがき
実際に設計からコーディング、デプロイと一連の流れを山程の粗と無知故のクオリティの低さに目をつぶれば曲がりなりにもこなしたわけですが、感想としては**とてもしんどい**という気持ちは確かにあります。嘘は言えません。
が、それと同じくらい一つ一つの処理が動作した瞬間や詰まっていたところがクリアできた瞬間などは嬉しかったですし、なんだかんだ3徹してしまったみたいなことも幾度とあり同じくらい楽しかった気持ちもありました。
しかし、この程度でしんどいと言っていますが、世の中アプリを1人で全部作ってる方はごまんといるわけでは相当チカラがあるんだなぁということをひしひしと感じました。

今後についてですが、就職するにあたってはPHP(Laravel)の方面で探していくことになりそうですが、同時にネットワークやアプリ制作についてまだまだスキルが足りていないのでかの有名なRailsのチュートリアル3周に挑戦してみようとは思っています。
Rails自体は今後勢い的には下火になるのでは？ といったような話も出ていますが

[こちらの記事](https://ogihara-ryo.github.io/career-path)にある通り、アプリ制作の流れやネットワーク周りに未熟さを感じているのであれば良い教材ではあると感じたので挑戦してみたいと思っています。
LaravelやPHPにより慣れる意味でもこちらでのアプリ制作もやるべきなのかということも思ってはいるのですがね。

このあと目指すべきところとしては

・就職をする（現在、書店員のフリーター)
・フルスタックエンジニアとして働けるようになる
・基本情報技術者の取得

の3つでしょうか、これ以上のスキルアップは独学のみより実務経験が効率を考えても必要になるのを感じていますので。
将来的な目標としては

・Pythonを扱えるようになりたい
・SwiftでiOSアプリを制作したい

ということの2点になります。

#### なぜエンジニアを志望したのか

最後に簡単に触れておきます。
まず、最初に単純に手に職がつくということと、今の自分の就職の可能性を考えるとここが1番可能性があるという打算的なものは当然あります。嘘は言えません。
ですが、これまでガチガチの文系でプログラミングのプの字も知らない自分がこうして自分でアプリを作ってみるまでに至るくらいに本気になれたのかというと、2019年のWWDCでのアップルのセッションで発表された**「Introducing SwiftUI: Building Your First App」**がきっかけだったと思います。
今はお金の都合でWindowsを使っていますが、自分は物心ついた頃から家にあるのはMacのみだったという筋金入りのマカーですので毎年プロダクトとサービスのの発表はチェックしてはいるもののエンジニア周りのセッションはみたことがなかったのですが、今年はTwitterのトレンドにこれが載っていたのを偶然発見して、興味を持って調べてみるとまあこれがとても面白そうだったんですよね。**「コピペでアプリ作れるのか！」**と。
その時点では確かマークアップ言語周りのチュートリアルをやっていて、自分がエンジニアになれるのか？ アルゴリズムの言語とか文系の自分がやれるのか？ といったことを考えてしまいイマイチ本気になれなかったのですが、以後真剣に取り組むようになってなんとか今回こうやってアプリを作った記録を書けるまでになりました。
もし、私と同じような全くな未経験で勉強している方がいらっしゃいましたら不安はいくらでもあってもなんとか独学だけでここまではこれます。なので、諦めずに頑張って欲しいです。
ということでこれから就職活動に移ることになりますので、もしこの記事をみて興味を持たれた採用担当の方や現役エンジニアの方がいらっしゃいましたらお声をかけて頂けると嬉しいです。
最も業界のことについては全くの勉強不足なのでそこをどうにかしながらにはなりますが……

[参考:WWDC19で押さえておきたいと思ったセッション10選](https://medium.com/mixi-developers/wwdc19-10-sessions-a1ba238166f)

最後になりますがteratailで以下の私の質問に回答して頂いた皆さんに感謝を。

[日時と場所を指定する利用登録に関するテーブル定義とリレーションについて](https://teratail.com/questions/225110)

[Laravelにおいて外部キーを主キーとしているテーブルとで適切なリレーションができているかわからない。](https://teratail.com/questions/225965)

[Ajaxで受け取ったテーブルの情報から時間比較をしたい。](https://teratail.com/questions/228684)

[Javascriptにおいて配列の中の時間の最大値や最小値、及び間の時刻を取得したい。](https://teratail.com/questions/230185)

[Laravel(PHP)において無効なフォームの情報が送信された時に入力画面にリダイレクトしたい。](https://teratail.com/questions/233612)



皆さんの優しく、丁寧な回答がなければ不出来ながらもここまで作業を完遂させることは到底できませんでした。月並みな言葉にはなってしまいますが、本当に感謝しています。ありがとうございました。

##主な参考サイト

[ダーティリード・ノンリピータブルリード（ファジーリード）・ファントムリードの違い](https://high-programmer.com/2017/10/18/db-isolationlevel/#i-5)

[JavaScriptでオブジェクトや配列の特定のキーの値だけを取り出す](https://s8a.jp/javascript-object-array-property-function)

[npmでのJSライブラリインストール＆ビルド(※Laravel使用時)](http://skill-up-engineering.com/2017/11/23/npm%E3%81%A7%E3%81%AEjs%E3%83%A9%E3%82%A4%E3%83%96%E3%83%A9%E3%83%AA%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%AB/)

[JavaScriptの配列の使い方まとめ。要素の追加,結合,取得,削除。](https://qiita.com/takeharu/items/d75f96f81ff83680013f)

[Laravel 5.7で基本的なCRUDを作る](https://qiita.com/sutara79/items/ef30fcdfb7afcb2188ea)

[gitを使うなら最低限覚えておきたいgitコマンド6選](https://youmjww.hatenablog.jp/entry/2018/10/01/git%E3%82%92%E4%BD%BF%E3%81%86%E3%81%AA%E3%82%89%E6%9C%80%E4%BD%8E%E9%99%90%E8%A6%9A%E3%81%88%E3%81%A6%E3%81%8A%E3%81%8D%E3%81%9F%E3%81%84%E3%82%B3%E3%83%9E%E3%83%B3%E3%83%896%E9%81%B8)

[LaravelをGitで管理（Git Hub）](https://laraweb.net/environment/6516/)

[HerokuでMySQLを使おうとして詰まったところ](https://qiita.com/senou/items/108ef1d94dcb5b227b4f)

[HerokuにLaravelをデプロイする方法](https://blog.nakamu.life/posts/heroku-laravel-deploy#JavaScript_csssassHeroku_227)

[JavaScript の ジェネレータ を極める！](https://qiita.com/kura07/items/d1a57ea64ef5c3de8528#26-%E3%82%B8%E3%82%A7%E3%83%8D%E3%83%AC%E3%83%BC%E3%82%BF-%E3%81%AE%E3%82%82%E3%81%86%E4%B8%80%E3%81%A4%E3%81%AE%E5%88%A9%E7%94%A8%E6%B3%95)

[Laravelのバリデーションにはフォームリクエストを使おう](https://qiita.com/sakuraya/items/abca057a424fa9b5a187#authorize%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6)

[laravelでformのバリデーションをしよう！（カスタマイズあり）](https://qiita.com/n_oshiumi/items/327dfba44b8da117a5ff#%E8%A3%9C%E8%B6%B3%E3%83%90%E3%83%AA%E3%83%87%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%81%AE%E6%A9%9F%E8%83%BD%E3%82%92%E4%BD%BF%E3%82%8F%E3%81%9A%E3%81%AB%E3%83%90%E3%83%AA%E3%83%87%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%81%A3%E3%81%BD%E3%81%84%E3%81%93%E3%81%A8%E3%81%97%E3%81%9F%E3%81%84)

[LaravelのFormRequestでValidationエラーメッセージを日本語化する](https://qiita.com/shiro96/items/c4bb2c9bf271062d1b48)

[完全な手順！Laravelバリデーション前にデータを加工する方法](https://blog.capilano-fw.com/?p=579)

[全217件！Carbonで時間操作する実例](https://blog.capilano-fw.com/?p=867#format)

[PHPで二つの時間帯が重複しないかチェックする](https://sousaku-memo.net/php-system/184)

[【PHP】try-catch解説](https://qiita.com/Chelsea/items/59436cfda149a6ac6c91)

[エラー画面やAPIエラーから独自エラーまで！ フローチャートでちゃんと理解するLaravelの例外処理とケーススタディ](https://qiita.com/kd9951/items/b1bccc4666976ec90dcc#case-%E7%8B%AC%E8%87%AA%E3%81%AE%E3%82%A8%E3%83%A9%E3%83%BC%E3%82%92%E5%AE%9A%E7%BE%A9%E3%81%97%E3%81%A6%E7%8B%AC%E8%87%AA%E3%81%AE%E3%82%A8%E3%83%A9%E3%83%BC%E5%87%A6%E7%90%86%E3%82%92%E8%BF%BD%E5%8A%A0%E3%81%99%E3%82%8B)

[フロー図で理解するLaravelバリデータの仕組みと、チーム開発でのケーススタディ](https://qiita.com/kd9951/items/e797b17c03fc8e8f414b)

[Laravelで独自例外処理を実装する（楽観的排他制御andトランザクション処理）](https://qiita.com/sakuraya/items/a511f0e615717a6b7628)

[例外処理について](https://laraweb.net/surrounding/2192/)

[laravelでビューにエラーメッセージを渡す方法 （フォーム）](https://thai-bangkok.info/programming/php-laravel/laravel%E3%81%A7%E3%83%93%E3%83%A5%E3%83%BC%E3%81%AB%E3%82%A8%E3%83%A9%E3%83%BC%E3%83%A1%E3%83%83%E3%82%BB%E3%83%BC%E3%82%B8%E3%82%92%E6%B8%A1%E3%81%99%E6%96%B9%E6%B3%95-%EF%BC%88%E3%83%95%E3%82%A9)

[Herokuデプロイ後に出たエラーを解決するためにやったこと](https://qiita.com/acro_y/items/fc5d3fc94b4e5fe13bb5)

[MVCに基づいて設計する時に思う自分なりのベストプラクティス](http://rabbitfoot141.hatenablog.com/entry/2018/10/16/194555#Controller-%E3%81%AE%E5%BD%B9%E5%89%B2)

