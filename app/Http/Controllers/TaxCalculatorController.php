<?php

namespace App\Http\Controllers;

use App\TaxCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TaxCalculatorController extends Controller
{
    //

    public function index(){
        $tax_calculator_values = DB::table('tax_calculators')->get();
        return view('tax-calculator.index', compact('tax_calculator_values'));
    }


    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|max:250',
            'value' => 'required|numeric',
        ]);

        TaxCalculator::create($request->except('csrf_token'));

        $messages = array(
            'status' => 'success',
            'message' => 'Tax Calculator Value Saved Successful',
        );

        return redirect(route('tax-calculator-index'))->with('status', $messages);
    }


    public function destroy($id){
        DB::table('tax_calculators')
        ->where('id', $id)->delete();

        $messages = array(
            'status' => 'info',
            'message' => 'Tax Calculator Value Deleted Successful',
        );

        return redirect(route('tax-calculator-index'))->with('status', $messages);
    }
}
