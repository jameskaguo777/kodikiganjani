<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentConfiguration extends Model
{
    //

    protected $fillable = [ 'status', 'test_username', 'test_pass', 'live_username', 'live_pass' ];
}
