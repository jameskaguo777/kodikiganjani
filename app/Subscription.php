<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //, 'active', 'remaining_days', 'expiration'
    protected $fillable = [ 'user_id', 'packages_id', 'date_subscribed' ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function packages(){
        return $this->belongsTo(Package::class);
    }
}
