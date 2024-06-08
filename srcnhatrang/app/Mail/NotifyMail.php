<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $content;
    public $view; // Đặt thuộc tính view là public

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $content, $view = 'defaultMail')
    {
        $this->title = $title;
        $this->content = $content;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
            ->subject($this->title)
            ->with([
                'title' => $this->title,
                'content' => $this->content,
            ]);
    }
}
