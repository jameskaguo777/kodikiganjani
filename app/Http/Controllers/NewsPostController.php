<?php

namespace App\Http\Controllers;

use App\NewsPost;
use Illuminate\Http\Request;

class NewsPostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('news.create');
    }

    public function create(){
        return view('news.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required|max:255',
            'post' => 'required',
            'featured_image_url' => 'required|image',
        ]);


        // $request->session()->push('news.post', $request);
        // $request->session()->put('key', 'value');
        NewsPost::create($request->except('csrf_token'));
        $path = $request->file('featured_image_url')->store('news');
        dd($path);
        // dd($request->session()->all());
    }
}
