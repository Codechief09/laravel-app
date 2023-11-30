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
