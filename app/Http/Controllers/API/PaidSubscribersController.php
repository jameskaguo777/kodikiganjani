<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Package;
use App\PaidSubscriber;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\PaymentConfiguration;
use App\Subscription;
use App\Vushacallback;
use App\User;
use Exception;
use Illuminate\Http\Request;


class PaidSubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        $transactions = PaidSubscriber::where('email', $user->email)->get();
        return response()->json([
            'status' => 200,
            'data' => $transactions,
            'message' => 'OK',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function push(Request $request){
        $vusha_url = 'https://vushapg.vusha.co.tz/gateway/services/v1/collect/push';
        $payment = PaymentConfiguration::find(1)->first();
        $timestamp = Carbon::now()->toDateTimeString();
        $date_s = Carbon::now()->format('Y-m-d');
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

        try{ 

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
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
                    'msisdn' => $request->number,
                    'amount' => $request->amount,
                    
                ]
            ],
        ]);

    } catch(Exception $e){
        return response()->json([
            'status' => 200,
            'data' => $e,
            'message' => 'error',
            'request' => $request,
            
            
        ]);
    }


    $ta = $response->body();

    if ($response->successful()) {
        $return = json_decode($response->body())->body->response;

        if ($return->responseCode == 0) {
            $paid_customer = PaidSubscriber::create([
                
                'transaction_number' => $transactionNumber,
                'user_email' => $request['email'],
                'reference' => $return->reference,
                'pre_status' => $return->responseStatus,
                'pre_response_code' => $return->responseCode,
                'amount' => $request['amount'],
                'sub_time' => $request['sub_time'],
            ]);

            $subscription = Subscription::updateOrCreate([
                'user_id' => auth()->user()->id,
            ],
            [
                'package_id' => $request->package_id,
                'date_subscribed' => $date_s,
                'expiration' => Carbon::now()->copy()->addDays($request['sub_time'])->format('Y-m-d'),
            ]
        );
        }
    } else if($response->failed()){
        return response()->json([
            'status' => 200,
            'data' => $response->body(),
            'message' => 'error',
            'request' => $request,
            
            
        ]);
    }
    
        
        

        return response()->json([
            'status' => 200,
            'data' => json_decode($response->body())->body->response,
            'message' => 'OK',
            'request' => $request,
            
            
        ]);
        
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

            $paid_subs = DB::table('paid_subscribers')
            ->where('reference', $reference);
            
            $paid_subs
                ->update([
                    'payment_status'=>'COMPLETED',
                    'response_code'=>$result_code,
                    'pre_status' => $result_status,
                    'paid_at' => $timestamp_l,
                ]);

            if ($result_code=='0') {
                $date_s = Carbon::now();
                $user_id = User::where('email', $paid_subs->email)->id;
                $sub_ = Subscription::where('user_id', $user_id);
                $duration = Package::where('id', $sub_->packages_id)->duration;
                
               
                $sub_->update([
                    'active' => true,
                    'remaining_days'=> $duration,
                    'expiration' => $date_s->addDays($duration),
                ]);
            }

            

            
        } else {
            $affected = DB::table('paid_subscribers')
                ->where('reference', $reference)
                ->update([
                    
                    'response_code'=>$result_code,
                    'pre_status' => 'Authontication error '.$header['username'],
                    
                ]);
        }


        return response()->json($array['header'], 200);
    }
}
