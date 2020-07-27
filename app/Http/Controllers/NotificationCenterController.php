<?php

namespace App\Http\Controllers;

use App\NotificationCenter;
use Illuminate\Http\Request;
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

        $path = $request->file('featured_image_url')->store('notifications');

        NotificationCenter::create([
            'title' => $request->title,
            'summary' => $request->summary,
            
            'featured_image_url' => $path,
            
        ]);
        $messages = array(
            'status' => 'success',
            'message' => 'Notification Posted Successful',
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
