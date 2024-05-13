<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostsController extends Controller
{
    //Show posts
    public function index()
    {
        $models = Post::where("is_active","=",true)->
                        latest()->
                        filter(request(['search']))->
                        paginate(5);


        // Get comments for each post
        foreach($models as $model)
        {
            $comments = Comment::where("post_id","=",$model->id)->get();
            foreach ($comments as $comment) {
                $comment->load('User');
            }
            $model->comments = $comments;
        }

        return view("/home", ["models"=>$models, "pageTitle"=>"Posts"]);
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
            'image_path' => 'image'
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

        return redirect('/')->with('message', 'Post created successfully.');
    }

    //Show post
    public function show($id)
    {
        $model = Post::find($id);
        return view("posts.show", ["model"=>$model,"pageTitle"=>"Post"]);
    }

    //Edit post form
    public function edit($id)
    {
        $model = Post::find($id);
        return view("posts.edit", ["model"=>$model,"pageTitle"=>"Edit Post"]);
    }

    //Update post
    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'content' => 'required|min:5|max:255',
            'image_path' => 'image'
        ]);

        $formFields['user_id'] = auth()->user()->id;

        //Upload image
        if ($request->has('image_path')) {
            $image = $request->file('image_path');
            $imageName = auth()->user()->name . time() . '.' . $image->extension();
            $image->move(public_path('img/posts/'), $imageName);
            $formFields['image_path'] = $imageName;
        }

        $post = Post::find($id);
        $post->update($formFields);

        return redirect('/')->with('message', 'Post updated successfully.');
    }

    //Delete post
    public function destroy($id)
    {
        $post = Post::find($id);
        //$post->is_active = 0;
        //$post->update();
        $post->delete();

        return redirect('/')->with('message', 'Post deleted successfully.');
    }

    //Delete post AJAX
    public function destroyAjax($id)
    {
        $post = Post::find($id);

        if($post != null){
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully.'], 200);
        }
        else{
            return response()->json(['message' => 'Post not found.'], 404);
        }
    }
}
