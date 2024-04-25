<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    //
    function index(){
        $posts = Post::all();
        return $posts;
    }

    function store(StorePostRequest $request){
        $validData = $request->validated();
        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            $validData['photo'] = $path;
        }
        $validData['title'] = $request->title;
        $validData['body'] = $request->body;
        $validData['user_id'] = $request->user_id;
        Post::create($validData);
        return "Post created successfully";
    }

    function show($id){
        $post=Post::find($id);
        return $post;
    }

    public function update($id, Request $request )
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required|min:2',
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->user_id = $request->user_id;
            if ($request->hasFile('photo')) {
                Storage::delete($post->photo);
                $path = $request->file('photo')->store('public/photos');
                $post->photo = $path;
            }
            $post->save();
            return "Post updated successfully";
        } catch (\Exception $e) {
            return "Failed to update post: " . $e->getMessage();
        }
    }

    function destroy($id){
        post::destroy($id);
        return "Post was deleted sucessfully";
    }
}
