<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaidSubscriber extends Model
{
    //
    protected $fillable = [ 'user_email', 'amount', 'sub_time', 'transaction_number', 'response_code', 'gateway_id', 'paid_at', 'pre_status', 'pre_response_code', 'reference', 'payment_status' ];
}
