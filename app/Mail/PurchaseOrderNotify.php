<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class PurchaseOrderNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $index;
    public $pushOrderData;


   public function __construct(User $user,  $index,  $pushOrderData)
   {
       $this->user = $user;
       $this->index = $index;
       $this->pushOrderData = $pushOrderData;
   }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pushordernotify')
        ->with([
            'user' => $this->user,            
            'index' => $this->index,  
            'pedido'  => $this->pushOrderData   
            ]
        );
        // return $this->view('view.name');
    }
}
