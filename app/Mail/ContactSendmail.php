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
