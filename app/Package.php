<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    protected $fillable = [ 'name', 'desc', 'amount', 'duration' ];


    public function subscription(){
        return $this->hasOne(Subscription::class);
    }
}
