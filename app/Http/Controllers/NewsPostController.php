<?php

namespace App\Http\Controllers;

use App\NewsPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsPostController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){
        $newsposts = DB::table('news_posts')->orderByDesc('id')->paginate(10);
        
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
        $messages = array(
            'status' => 'success',
            'message' => 'Post Saved Successful',
        );
        return redirect(route('news-index'))->with('status', $messages);
        
        // NewsPost::create($request->except('csrf_token'));
        // $path = $request->file('featured_image_url')->store('news');
        // dd($path);
        
    }

    public function show($id){
        $newspost = DB::table('news_posts')->find($id);
        return view('news.show', compact('newspost'));
    }

    public function edit($id){
        $newspost = DB::table('news_posts')->find($id);
        return view('news.edit', compact('newspost'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required|max:255',
            'post' => 'required',
            'featured_image_url' => 'required|image',
        ]);
        $newspost = DB::table('news_posts')
        ->where('id', $id);

        $path = $request->file('featured_image_url')->store('news');

        $before = $newspost->first();

        if (Storage::exists($before->featured_image_url)) {
            Storage::delete($before->featured_image_url);
        } else {
            # code...
        }
        

        $newspost->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'featured_image_url' => $path,
            'tags' => $request->tags,
        ]);
        $newspost = $newspost->get();

        $messages = array(
            'status' => 'success',
            'message' => 'Post Updated Successful',
        );
        return redirect(route('news-show', compact('newspost','id')))->with('status', $messages);
    }

    public function destroy($id){

        $model = DB::table('news_posts')
        ->where('id', $id);

        $model1 = $model->first();

        if (Storage::exists($model1->featured_image_url)) {
            Storage::delete($model1->featured_image_url);
        }

        
        $model->delete();

        $messages = array(
            'status' => 'info',
            'message' => 'Post Deleted Successfuly',
        );
        return redirect(route('news-index'))->with('status', $messages);
    }
}
