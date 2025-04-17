<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $studentData;

    /**
     * Create a new message instance.
     */
    public function __construct($studentData)
    {
        $this->studentData = $studentData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notifikasi Borang Hubungi Untuk Admin - Kolej UNITI')
                    ->view('emails.student-registration');
    }
}