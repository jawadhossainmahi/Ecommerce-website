<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Orders;

class OrderDeliveredEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Orders
     */
    public $orders;

    public $discount_without_coupons;

    public $total;

    public $total_discount;

    public $tax;

    public $totalTaxAmt12 = 0;
    public $totalTaxAmt25 = 0;

    public $sendtoadmin;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Orders $orders, $sendtoadmin = false)
    {
        $this->orders = $orders;
        list($this->discount_without_coupons, $this->total, $this->total_discount, $this->tax, $this->totalTaxAmt12, $this->totalTaxAmt25) = order_details($this->orders);
        $this->sendtoadmin = $sendtoadmin;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Livshem leveransbekräftelse',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orderdelivered');
    }
}
