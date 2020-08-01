<?php

namespace App\Http\Controllers;

use App\NotificationCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class NotificationCenterController extends Controller
{
    //
    

    public function index(){
        $notifications = NotificationCenter::orderByDesc('id')->get();
        return view('notification.index', compact('notifications'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required|max:255',
            
            'featured_image_url' => 'required|image',
        ]);

        

        $url = 'https://fcm.googleapis.com/fcm/send';

        $path = $request->file('featured_image_url')->store('notifications');

        $token = "AAAAdPJ82Z8:APA91bGbgcM0aXOw8GDuJWEEccsvhp9ZiDu1wcDELgREn-tt1z0DzlgD622nFgJ6zdTmp9TgTMhUNZdjR4P1MzeTce6h_ERFB3Eub7-aTlb7A1ig_2ECmnc5O5RRfBly04HQLvjUf71i";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=> 'key='. $token,
        ])->post($url, [
            'notification' => [
                'body' => $request->summary,
                'title' => $request->title,
                'image' => 'http://'.request()->getHttpHost().$path,
                
            ],
            'priority'=> 'high',
            'data' => [
                'click_action'=> 'FLUTTER_NOTIFICATION_CLICK',
                
                'status'=> 'done',
                
            ],
            'to' => '/topics/all'
        ]);


        
        

        NotificationCenter::create([
            'title' => $request->title,
            'summary' => $request->summary,
            
            'featured_image_url' => $path,
            
        ]);
        $messages = array(
            'status' => 'success',
            'message' => 'Notification Posted Successful '. $response->body() ,
        );
        return redirect(route('noti-index'))->with('status', $messages);
    }

    public function destroy($id){
        $model = NotificationCenter::where('id', $id);

        $model1 = $model->first();

        if (Storage::exists($model1->featured_image_url)) {
            Storage::delete($model1->featured_image_url);
        }

        
        $model->delete();

        $messages = array(
            'status' => 'info',
            'message' => 'Notification Deleted Successfuly',
        );
        return redirect(route('noti-index'))->with('status', $messages);
    }

    public function create(){

    }
}
