<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class NotificationCenter extends Model
{
    //
    protected $fillable = [ 'title', 'summary', 'featured_image_url' ];

    protected $appends=['published'];

    public function getPublishedAttribute(){
        
            return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
        }
}
