<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.register')
            ->from(
                env("MAIL_FROM_ADDRESS", 'no-reply@rterminal.ru'),
                env("MAIL_FROM_NAME", 'ГК Терминал'),
            )
            ->subject('Создание учетной записи')
            ->with([
                'email' => $this->data['email'],
                'password' => $this->data['password'],
                'role' => User::ROLES[$this->data['role']],
                'url' => url()->to('/')
            ]);
    }
}
