<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTransaction extends Model
{
    use HasFactory;

    protected $guarded=[];


    const NEW_ORDER = 0;
    const PAYMENT_COMPLETED = 1;
    const UNDER_PROCESS = 2;
    const FINISHED = 3;
    const REJECTED = 4;
    const CANCELED = 5;
    const REFUNDED_REQUEST = 6;
    const REFUNDED = 7;
    const RETURNED = 8;


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function status()
    {
        switch ($this->order_status){

            case 0: $result ='New Order' ; break;
            case 1: $result ='Paid' ; break;
            case 2: $result ='Under Process' ; break;
            case 3: $result ='Finished' ; break;
            case 4: $result ='Rejected' ; break;
            case 5: $result ='Canceled' ; break;
            case 6: $result ='Refund Requested' ; break;
            case 7: $result ='Refunded' ; break;
            case 8: $result ='Returned Order' ; break;


        }

        return $result;
    }
}
