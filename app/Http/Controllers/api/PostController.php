<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    //
    function index(Request $request){
        // $posts = Post::all();
        $posts = Post::with('user')->paginate($request->input('per_page', 5));
        return PostResource::collection($posts);
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
        $post = Post::with('user')->findOrFail($id);
        return new PostResource($post);;
    }

    function update($id, StorePostRequest $request){
        $post = Post::with('user')->findOrFail($id);
        if (!$post) {
            return response("Post not found", 404);
        }
        $validData = $request->validated();
        if ($request->hasFile('photo')) {
            if ($post->photo) {
                Storage::delete($post->photo);
            }
            $path = $request->file('photo')->store('public/photos');
            $validData['photo'] = $path;
        }
        $post->update($validData);
        return "Post was updated successfully";
    }

    function destroy($id){
        post::destroy($id);
        return "Post was deleted sucessfully";
    }
}
