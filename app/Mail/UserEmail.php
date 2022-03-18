<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   

    protected $u_info;

    public function __construct($u_info)
    {
        $this->u_info = $u_info;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('abmsumonhosen@gmail.com', 'Mailtrap')
            ->subject('Queued Email')
            ->view('send_mail',['info'=>$this->u_info]);
    }
}
