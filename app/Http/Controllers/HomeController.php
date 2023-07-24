<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\post;
use Database\Factories\PostFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    function index() {
        $posts= Post::latest()->paginate(6);
        return view('home')->with([

            "posts" =>$posts
        ]);
    }
    public function show($slug){
        $post = Post::where('slug', $slug)->first();
        return view('show')->with([
        'post'=>$post
            ]);
    }
    public function create(){
        return view('create');
    }
  public function store(PostRequest $request){

        if($request->has('image')){
            $file = $request->image;
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'),$image_name);
        }

  Post::create([
      'title'=>$request->title ,
      'body'=>$request->body,
       'slug'=>Str::slug($request->title),
      'image'=>  $image_name,
      'user_id'=> auth()->user()->id
  ]);
 return redirect()->route('home')->with([
     'success'=>'article ajouter'
 ]);
    }
   public function edit($slug){
       $post = Post::where('slug', $slug)->first();
       return view('edit')->with([
           'post'=>$post
       ]);
   }

   public function update(PostRequest  $request ,$slug){
       $post = Post::where('slug', $slug)->first();
       if($request->has('image')){
           $file = $request->image;
           $image_name = time().'_'.$file->getClientOriginalName();
           $file->move(public_path('uploads'),$image_name);
           unlink(public_path('uploads').'/'.$post->image);
           $post->image= $image_name;
       }

       $post->update([
           'title'=>$request->title ,
           'body'=>$request->body,
           'slug'=>Str::slug($request->title),
           'image'=>$post->image,
           'user_id'=> auth()->user()->id
       ]);
return redirect()->route('home')->with([
    'success'=>'article modifier'
]);

   }
 public function delete($slug){
    $post = Post::where('slug', $slug)->first();
    $post->delete();
    return redirect()->route('home')->with([
        'success'=>'article suprimmer'
    ]);
}



}
