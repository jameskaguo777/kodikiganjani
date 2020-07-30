<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user()->id;
        $subscriber = Subscription::where('user_id', $user);

        if ($subscriber->exists()) {
            // $model = Subscription::get();
        $date_s = Carbon::now();
            $sub_time = Carbon::parse($subscriber->first()->expiration);
            $date_passed = $sub_time>$date_s;

            if ($date_passed) {
                Subscription::where('user_id', $user)->update([
                    'active' => true,
                    'remaining_days' => $sub_time->diffInDays($date_s),
                ]);
            } else {
                Subscription::where('user_id', $user)->update([
                    'active' => false,
                    'remaining_days' => 0,
                ]);
            }
            

            
            return response()->json([
                'status' => 200,
                'data' => auth()->user()->subscriber,
                'message' => 'OK',
                
                
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'data' => '0',
                'message' => 'OK',
                
                
            ]);
        }
        
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
}
