<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Orders;
// ConfirmationEmail RefundOrderEmail
// class ConfirmationEmail extends Mailable
class RefundOrderEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * The order instance.
     *
     * @var \App\Models\Orders
     */
    public $orders;
    
    
    public $sendtoadmin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     
    public function __construct(Orders $orders, $sendtoadmin = false)
    {
        $this->orders = $orders;
        $this->sendtoadmin = $sendtoadmin;
    }
    
     public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Livshem Beställningsbelopp återbetalat',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.refund-order');
    }
}
