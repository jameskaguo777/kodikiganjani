<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //

    public function index(){

        $subscribers = Subscription::where('active', true)->get();
        return view('users.subscribers', compact('subscribers'));
    }

    public function expired(){
        $subscribers = Subscription::where('active', false)->get();
        return view('users.expiredsubs', compact('subscribers'));
    }
}
