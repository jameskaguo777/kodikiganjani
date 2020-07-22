<?php

namespace App\Http\Controllers;

use App\AboutInfo;
use Illuminate\Http\Request;

class AboutInfoController extends Controller
{
    //
    public function index(){

        $about_info = AboutInfo::findOrFail(1);
        return view('about_info.index', compact('about_info'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'post' => 'required',
        ]);

        AboutInfo::where('id', 1)
        ->update([
            'post' => $request->post
        ]);

        $messages = array(
            'status' => 'success',
            'message' => 'Changes Saved Successful',
        );

        return redirect(route('about-info-index'))->with('status', $messages);
    }
}
