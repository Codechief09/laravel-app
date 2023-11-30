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