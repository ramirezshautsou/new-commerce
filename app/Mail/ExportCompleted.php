<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ExportCompleted extends Mailable
{
    public function __construct(
        protected $downloadFilePath,
    ) {}

    public function build(): ExportCompleted
    {
        return $this->from('belford2014@gmail.com') // ONLY VERIFIED EMAIL //
            ->subject('Your Export is Ready') // lang
            ->view('emails.exportCompleted')
            ->with(['downloadFilePath' => $this->downloadFilePath]);
    }
}
