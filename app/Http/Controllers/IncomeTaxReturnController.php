<?php

namespace App\Http\Controllers;

use App\IncomeTaxReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeTaxReturnController extends Controller
{
    //

    public function index(){

        $inc_tax = IncomeTaxReturn::findOrFail(1);
        return view('income_tax.index', compact('inc_tax'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'post' => 'required',
        ]);

        IncomeTaxReturn::where('id', 1)
        ->update([
            'post' => $request->post
        ]);

        $messages = array(
            'status' => 'success',
            'message' => 'Changes Saved Successful',
        );

        return redirect(route('inc-tax-index'))->with('status', $messages);
    }
}
