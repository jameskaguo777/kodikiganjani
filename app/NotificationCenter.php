<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationCenter extends Model
{
    //
    protected $fillable = [ 'title', 'summary', 'featured_image_url' ];
}
