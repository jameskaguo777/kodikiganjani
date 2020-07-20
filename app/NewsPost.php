<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    //

    protected $fillable = [ 'title', 'summary', 'post', 'featured_image_url', 'tags' ];


}
