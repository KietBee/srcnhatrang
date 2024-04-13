<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Headers;

class SendMail extends Controller
{
    /**
     * Get the message headers.
     */
    public function headers(): Headers
    {
        return new Headers(
            text: [
                'X-Ses-List-Management-Options' => 'contactListName=MyContactList;topicName=MyTopic',
            ],
        );
    }
}
