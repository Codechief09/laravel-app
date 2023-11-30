<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Http\Requests\SendMailRequest;

class TestMailController extends Controller {

/*
	// フォームからのリクエストデータからメールの送信先や宛先人を設定する場合はstoreメソッドでallを使う。
	
	public function store(SendMailRequest $request) {
		$content = $request->all();
	
	Mail::to($content->email)->send(new Sendmail());

	// データを変数に入れて渡す場合はこちら。テンプレートで{{ $content->name }}等を使う場合。
	Mail::to($content->email)->send(new Sendmail($content));


	}

	*/


	// テスト実行だけならこっち

	public function send() {
		return Mail::to('test@example.com')
			->send(new SendMail());
	}
}
