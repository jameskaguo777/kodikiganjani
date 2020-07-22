<?php

namespace App\Http\Controllers;

use App\TaxCalender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class TaxCalenderController extends Controller
{
    //
    public function index(){
        $calender = TaxCalender::get();
        return view('tax-calender.index', compact('calender'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|max:250',
            'summary' => 'required|max:250',
            'tax_date' => 'required|date',
        ]);

        TaxCalender::create([
            'name' => $request->name,
            'summary' => $request->summary,
            'tax_date' => date("Y-m-d", strtotime($request->tax_date)),
        ]);

        $messages = array(
            'status' => 'success',
            'message' => 'Tax Calender Saved Successful',
        );

        return redirect(route('tax-calender-index'))->with('status', $messages);
    }


    public function destroy($id){
        DB::table('tax_calenders')
        ->where('id', $id)->delete();

        $messages = array(
            'status' => 'info',
            'message' => 'Tax Calender Deleted Successful',
        );

        return redirect(route('tax-calender-index'))->with('status', $messages);
    }
}
