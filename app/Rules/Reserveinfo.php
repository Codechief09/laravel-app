<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class Reserveinfo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        // フォームのstart_timeとend_timeを取得してその時間帯が既存の予約と重複していないか確認する
        
        if(isset($_POST['start_time']) && isset($_POST['end_time']) {
           
            // datetime型に整形
            $start_datetime =$_POST['dateinfo'] .' '. $_POST['start_time'];
            $end_datetime =$_POST['dateinfo'] .' '. $_POST['end_time'];

            // Carbonに整形
            
            $start = new Carbon($start_datetime);
            $end = new Carbon($end_datetime);

            // テーブルから予約情報取得して配列に格納
            // それぞれ$arr_start_time[]と＄arr_end_times[]で呼び出せるようにする
            // forかwhile文で$start_time[n]と$end_time[n]まで検証する
            
            // $arr_start_time及び$arr_end_timeの配列の数を取得する。
            $c1 = count($arr_start_time);
            $c2 = count($array_end_time);

            // 時間帯比較の関数
            function isTimeDuplication($start, $end, $arr_start_time[$i], $arr_end_time[$i]) {
                return ($start < $arr_end_time[$i] && $arr_start_time[$i] < $end);
                }

            // 予約情報の数だけ時間帯比較を行う
            for ($i=0; $i < $c1 && $c2 ; $i++) {

                isTimeDuplication($start, $end, $start_time[$i], $end_time[$i]);

                // 時間帯比較がTRUE、つまり重複した時間帯であった場合エラーメッセージ、違うなら繰り返しを続行する。
                if(isTimeDuplication() === TRUE) {

                    return false;
                    break;

                } else {

                    return true;


                }

            }
           
        }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'その時間は既に予約があるか無効な時間です。お手数ですがもう一度選択してください。';
    }
}
