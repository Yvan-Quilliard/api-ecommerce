<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user, $order;

    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function build(): self
    {
        $mail = $this->to($this->user->email)
            ->subject('Votre commande a bien été prise en compte !')
            ->with([
                'user' => $this->user,
                'order' => $this->order
            ])
            ->view('emails.mail-new-order');
        if (!file_exists(storage_path('app/orders-summary/' . $this->order->id . ' . pdf'))) {
            $mail->attach(storage_path('app/orders/' . $this->order->id . ' . pdf'), [
                'as' => 'order_summary . pdf',
                'mime' => 'application / pdf',
            ]);
        }

        return $mail;
    }

}
