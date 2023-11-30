<?php

namespace App\Http\Controllers;

use App\UserModel;
use App\Http\Requests\UserModelRequest;
use Illuminate\Http\Request;


class UserModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // 一覧表示
    public function index() {


        $usermodels = UserModel::all();
        $usermodels = usermodel::paginate(5); // ペジネーションに関しての設定
        \Debugbar::info(['$usermodels='=>$usermodels->toArray()]); // デバックバーのロギング
        return view('usermodel.index', compact('usermodels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /*1件のデータを新規作成。本来は必要がない（WebAPIにおいて、画面に登録フォームを表示する画面はいらないから）。
    storeメソッドとセット。
    */
    public function create() {

        return view('usermodel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // createメソッドで飛ばされた先の実際の処理
    public function store(UserModelRequest $request) {
        $usermodel = new UserModel;

        // フォームから受け取った値をすべて格納する
        $form = $request->all();

        // fill()->save();でフォームから受け取った値をもとに複数のカラムの値を更新・追加しセーブする。
        // UserModelのprotect $fillableの項目も参照。
        unset($form['_token']);
        $usermodel->fill($form)->save();

        return redirect('usermodel/' . $usermodel->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     /*
    レコード表示。indexと違ってidで紐つけて1件ずつ表示する。
    テスト用としてviewはつくらず、返された連想配列を単に表示するだけにしている。
     */
    public function show(UserModel $usermodel)
    {
        \Debugbar::info('$usermodel='.$usermodel);
         return view('usermodel.show', compact('usermodel'));
         // オブジェクトを単なる連想配列として返すだけ。
         // return $usermodels->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // 更新処理。updateメソッドとセット
    
    // モデル結合ルート、引数にコントローラー名とその変数をいれるとFindorFail()を含めた一連の処理を書かなくて済む。
    public function edit(UserModel $usermodel) {
       return view('usermodel/edit', compact('usermodel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // 更新処理
    public function update(UserModelRequest $request, UserModel $usermodel)
    {
        // 更新するカラムの数だけインスタンスにアクセスする。
        $usermodel->user_name = $request->user_name;
        $usermodel->email = $request->email;
        $usermodel->save();
        return redirect('usermodel/'.$usermodel->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // 削除処理
    public function destroy(UserModel $usermodel) {
        $usermodel->delete();
        return redirect('usermodel');
    }
}
