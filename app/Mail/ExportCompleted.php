<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ExportCompleted extends Mailable
{
    public function __construct(public $fileUrl)
    {
    }

    public function build()
    {
        return $this->from('belford2014@gmail.com') // ONLY VERIFIED EMAIL
            ->subject('Your Export is Ready')
            ->view('emails.exportCompleted')
            ->with(['fileUrl' => $this->fileUrl]);
    }
}
