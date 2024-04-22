<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    //Show posts
    public function index()
    {
        $models = Post::where("is_active","=",true)->get();
        return view("home", ["models"=>$models,"pageTitle"=>"Posts"]);
    }

    //Create new post form
    public function create()
    {
        return view("posts.create", ["pageTitle"=>"Create Post"]);
    }

    //Store new post
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'content' => 'required|min:5|max:255',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $formFields['user_id'] = auth()->user()->id;

        //Upload image
        if ($request->has('image_path')) {
            $image = $request->file('image_path');
            $imageName = auth()->user()->name . time() . '.' . $image->extension();
            $image->move(public_path('img/posts/'), $imageName);
            $formFields['image_path'] = $imageName;
        }

        $post = Post::create($formFields);

        return redirect('/home')->with('message', 'Post created successfully.');
    }
}
