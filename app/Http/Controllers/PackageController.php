<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PackageController extends Controller
{
    //

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:100',
            'desc' => 'required|max:200',
            'amount' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        Package::create($request->except('csrf_token'));

        $messages = array(
            'status' => 'success',
            'message' => 'Package Saved Successful',
        );

        return redirect(route('packages-index'))->with('status', $messages);

    }

public function destroy($id){
    DB::table('packages')
    ->where('id', $id)->delete();

    $messages = array(
        'status' => 'info',
        'message' => 'Package Deleted Successful',
    );

    return redirect(route('packages-index'))->with('status', $messages);
    }
}
