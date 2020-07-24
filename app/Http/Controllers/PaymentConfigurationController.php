<?php

namespace App\Http\Controllers;

use App\PaymentConfiguration;
use Illuminate\Http\Request;

class PaymentConfigurationController extends Controller
{
    //

    public function index(){
        $conf = PaymentConfiguration::find(1)->first();
        return view('payment_conf.index', compact('conf'));
    }

    public function store(){

    }

    public function update(Request $request){
        if ($request->status=='Live') {
            $status = true;
        } else {
            $status = false;
        }
        
        $conf = PaymentConfiguration::where('id', 1);
        $conf->update([
            'status' => $status,
            
            'test_username' => $request->test_acc,
            'test_pass' => $request->test_pass,
            'live_username' => $request->live_acc,
            'live_pass' => $request->live_pass,
        ]);

        $messages = array(
            'status' => 'success',
            'message' => 'Changes Saved Successful',
        );

        return redirect(route('pay-conf-index'))->with('status', $messages);
    }
}
