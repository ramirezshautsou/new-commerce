<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ExportCompleted extends Mailable
{
    /**
     * @param $downloadFilePath
     */
    public function __construct(
        protected $downloadFilePath,
    ) {}

    /**
     * @return ExportCompleted
     */
    public function build(): ExportCompleted
    {
        return $this->from(env('MAIL_ADMIN_ADDRESS'))
            ->subject(__('emails.export_subject'))
            ->view('emails.exportCompleted')
            ->with(['downloadFilePath' => $this->downloadFilePath]);
    }
}
