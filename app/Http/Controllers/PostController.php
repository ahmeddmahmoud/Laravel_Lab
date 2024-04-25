<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function index(){
        // $posts=Post::all();
        $posts = Post::paginate(3);
        return view('posts.index',["posts"=>$posts]);
    }

    function create(){
        return view("posts.create");
    }

    function store(StorePostRequest $request){
        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
        }

        Post::create(
            [
                "title"=>$request->title,
                "body"=>$request->body,
                "photo" => $path,
                "user_id"=>Auth::id()
            ]
            );
        return redirect("/posts");
    }

    function show($id){
        $post=Post::find($id);
        return view("posts.view",["post"=>$post]);
    }

    function edit($id){
        $post=Post::find($id);
        return view("posts.edit",["post"=>$post]);
    }

    function update($id, StorePostRequest $request){
        $post=Post::find($id);
        $post->title=$request->title;
        $post->body=$request->body;
        if ($request->hasFile('photo')) {
            if ($post->photo) {
                Storage::delete($post->photo);
            }
            $path = $request->file('photo')->store('public/photos');
            $post->photo = $path;
        }
        $post->save();
        return redirect("/posts");
    }

    function destroy($id){
        post::destroy($id);
        return redirect("/posts");
    }
}
