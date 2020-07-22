<?php

namespace App\Http\Controllers;

use App\RegisterNewBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterNewBusinessController extends Controller
{
    //

    public function index(){
        $reg_new = RegisterNewBusiness::findOrFail(1);
        return view('reg_new_business.index', compact('reg_new'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'post' => 'required',
        ]);

        RegisterNewBusiness::where('id', 1)
        ->update([
            'post' => $request->post
        ]);

        $messages = array(
            'status' => 'success',
            'message' => 'Changes Saved Successful',
        );

        return redirect(route('reg-business-index'))->with('status', $messages);
    }
}
