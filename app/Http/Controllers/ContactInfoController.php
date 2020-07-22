<?php

namespace App\Http\Controllers;

use App\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactInfoController extends Controller
{
    //
    public function index(){
        $contacts = ContactInfo::get();
        return view('contacts.index', compact('contacts'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        ContactInfo::create($request->except('csrf_token'));

        $messages = array(
            'status' => 'success',
            'message' => 'Changes Saved Successful',
        );

        return redirect(route('contacts-index'))->with('status', $messages);
    }


    public function destroy($id){
        DB::table('contact_infos')
        ->where('id', $id)->delete();

        $messages = array(
            'status' => 'info',
            'message' => 'Contact Deleted Successful',
        );

        return redirect(route('contacts-index'))->with('status', $messages);
    }
}
