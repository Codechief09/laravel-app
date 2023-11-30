<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sendmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('example@example.com')// 宛先
            ->subject('テスト送信完了')// 件名
            ->view('emails.test');
            // ->with(['content' => $this->content]); // withでセットしたデータをviewへ渡す。フォームからデータを受け取り、それに基づいて送信先等を決めるとき。
    }
}
