<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxCalender extends Model
{
    //

    protected $fillable = [ 'name', 'summary', 'tax_date' ];
}
