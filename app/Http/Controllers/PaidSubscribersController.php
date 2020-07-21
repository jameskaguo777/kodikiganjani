<?php

namespace App\Http\Controllers;

use App\PaidSubscriber;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\PaymentConfiguration;
use App\Vushacallback;
use Illuminate\Http\Request;

class PaidSubscribersController extends Controller
{
    //

    public function push(Request $request){
        $vusha_url = 'http://vushapg.vusha.co.tz/gateway/services/v1/collect/push';
        $payment = PaymentConfiguration::find(1)->first();
        $timestamp = Carbon::now()->toDateTimeString();
        $transactionNumber = $request['sub_time']. '-' .$request['amount']. '-' .$timestamp;
        $vusha_username = "";
        $vusha_pass = "";
        $timestamp_l = Carbon::now()->timestamp;
        if ($payment->status) {
            $vusha_username = $payment->live_username;
            $vusha_pass = $payment->live_pass;
        } else{ 
            $vusha_username = $payment->test_username;
            $vusha_pass = $payment->test_pass;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->post($vusha_url, [
            'header' => [
                'username' => $vusha_username,
                'password' => $vusha_pass,
                'timestamp' => $timestamp_l,
            ],
            'body' => [
                'request' => [
                    'command' => 'Customer Paybill',
                    'transactionNumber' => $transactionNumber,
                    'paymentDate' => $timestamp,
                    'msisdn' => $request['number'],
                    'amount' => $request['amount'],
                    
                ]
            ],
        ]);
        
        $return = $response['body']['response'];

        if ($return['responseCode'] == 0) {
            $paid_customer = PaidSubscriber::create([
                
                'transaction_number' => $transactionNumber,
                'user_email' => $request['email'],
                'reference' => $return['reference'],
                'pre_status' => $return['responseStatus'],
                'pre_response_code' => $return['responseCode'],
                'amount' => $request['amount'],
                'sub_time' => $request['sub_time'],
            ]);
        }

        return response()->json($response['body'], 200);
        
    }

    public function callback(Request $request){

        VushaCallback::create([
            'form' => "$request"
        ]);
        
        
        $array = $request->json()->all();
        
        $payment = PaymentConfiguration::find(1)->first();
        $header = $array['header'];
        $result = $array['body']['result'];
        $result_code = $result['resultCode'];
        $result_status = $result['resultStatus'];
        // $transactionNumber = $result['transactionNumber'];
        $reference = $result['referenceNumber'];
        $vusha_username = "";
        $vusha_pass = "";
        $timestamp_l = Carbon::now()->toDateTimeString();
        if ($payment->status) {
            $vusha_username = $payment->live_username;
            $vusha_pass = $payment->live_pass;
        } else{
            $vusha_username = $payment->test_username;
            $vusha_pass = $payment->test_pass;
        }
        
        if ($result_code == '0' && $header['username'] == $vusha_username) {
            
            $affected = DB::table('paid_customers')
                ->where('reference', $reference)
                ->update([
                    'payment_status'=>'COMPLETED',
                    'response_code'=>$result_code,
                    'pre_status' => $result_status,
                    'paid_at' => $timestamp_l,
                ]);
            
        } else {
            $affected = DB::table('paid_customers')
                ->where('reference', $reference)
                ->update([
                    
                    'response_code'=>$result_code,
                    'pre_status' => 'Authontication error '.$header['username'],
                    
                ]);
        }


        return response()->json($array['header'], 200);
    }
}
