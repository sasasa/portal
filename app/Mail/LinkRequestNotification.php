<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $link_request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($shop_name, $link_request)
    {
        $this->title = sprintf('%s の申請結果をお伝えいたします。', $shop_name);;
        $this->link_request = $link_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.link_request_notification')
                    ->text('emails.link_request_notification_plain')
                    ->subject($this->title)
                    ->with([
                        'link_request' => $this->link_request,
                    ]);
    }
}
