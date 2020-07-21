<?php

namespace App\Http\Controllers;

use App\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsPostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $newsposts = DB::table('news_posts')->get();
        return view('news.index', compact('newsposts'));
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

        $path = $request->file('featured_image_url')->store('news');

        NewsPost::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'post' => $request->post,
            'featured_image_url' => $path,
            'tags' => $request->tags,
        ]);

        
        // NewsPost::create($request->except('csrf_token'));
        // $path = $request->file('featured_image_url')->store('news');
        dd($path);
        
    }
}
