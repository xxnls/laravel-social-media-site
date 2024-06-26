<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;

class PostsController extends Controller
{
    //Number of posts per page
    private $postsPerPage = 5;

    //Show posts (search by post content by default)
    public function index()
    {
        // Handle search based on the search_type parameter
        $searchType = request('search_type', 'posts');
        $searchQuery = request('search', '');

        if ($searchType == 'users') {
            return $this->searchUsers($searchQuery);
        } else {
            return $this->searchPosts($searchQuery);
        }
    }

    private function searchPosts($query)
    {
        $models = Post::where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('content', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate($this->postsPerPage);

        // Load comments and likes for each post
        $this->loadCommentsAndLikes($models);

        return view('/home', ['models' => $models, 'pageTitle' => 'Posts']);
    }

    private function searchUsers($query)
    {
        $users = User::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->paginate($this->postsPerPage);

        return view('/home', ['models' => $users, 'pageTitle' => 'Users']);
    }

    //Show advanced search form
    public function createAdvancedSearch()
    {
        return view('advanced-search');
    }

    public function advancedSearch(Request $request)
    {
        $searchType = $request->input('search_type');
        $dateFrom = $request->input('creation_date_from');
        $dateTo = $request->input('creation_date_to');

        if ($searchType == 'posts') {
            return $this->searchPostsAdvanced($dateFrom, $dateTo);
        } else {
            return $this->searchUsersAdvanced($dateFrom, $dateTo);
        }
    }

    private function searchPostsAdvanced($dateFrom, $dateTo)
    {
        $query = Post::where('is_active', true);

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $models = $query->latest()->paginate(20);

        $this->loadCommentsAndLikes($models);

        return view('/home', ['models' => $models, 'pageTitle' => 'Posts']);
    }

    private function searchUsersAdvanced($dateFrom, $dateTo)
    {
        $query = User::where('is_active', true);

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $users = $query->latest()->paginate(20);

        return view('/home', ['models' => $users, 'pageTitle' => 'Users']);
    }

    private function loadCommentsAndLikes($models)
    {
        foreach ($models as $model) {
            $comments = Comment::where('post_id', '=', $model->id)->get();
            foreach ($comments as $comment) {
                $comment->load('user');
            }
            $model->comments = $comments;

            $model->isLiked = false;
            if (Auth::check()) {
                $like = Like::where('user_id', Auth::user()->id)->where('post_id', $model->id)->first();
                if ($like) {
                    $model->isLiked = true;
                }
            }
        }
    }

    //Show posts order by Likes amount
    public function indexByLikes()
    {
        $models = Post::where("is_active","=",true)->
                        withCount('likes')->
                        orderBy('likes_count', 'desc')->
                        paginate($this->postsPerPage);

        $this->loadCommentsAndLikes($models);

        return view("/home", ["models"=>$models, "pageTitle"=>"Trending posts"]);
    }

    //Show posts made by user
    // public function indexByUser()
    // {
    //     $models = Post::where("is_active","=",true)->
    //                     where("user_id","=",Auth::user()->id)->
    //                     latest()->
    //                     paginate(5);

    //     // Get comments for each post
    //     foreach($models as $model)
    //     {
    //         $comments = Comment::where("post_id","=",$model->id)->get();
    //         foreach ($comments as $comment) {
    //             $comment->load('User');
    //         }
    //         $model->comments = $comments;
    //     }

    //     // Check if post is liked by the authenticated user
    //     foreach($models as $model)
    //     {
    //         $model->isLiked = false;
    //         if (Auth::check()) {
    //             $like = Like::where('user_id', Auth::user()->id)->where('post_id', $model->id)->first();
    //             if ($like) {
    //                 $model->isLiked = true;
    //             }
    //         }
    //     }

    //     return view("/home", ["models"=>$models, "pageTitle"=>"User posts"]);
    // }

    //Show any posts that user interacted with (commented or liked)
    public function indexByUserInteraction()
    {
        $models = Post::where("is_active","=",true)->
                        whereIn('id', function($query) {
                            $query->select('post_id')->from('comments')->where('user_id', Auth::user()->id);
                        })->
                        orWhereIn('id', function($query) {
                            $query->select('post_id')->from('likes')->where('user_id', Auth::user()->id);
                        })->
                        latest()->
                        paginate($this->postsPerPage);

        $this->loadCommentsAndLikes($models);

        return view("/home", ["models"=>$models, "pageTitle"=>"Posts you interacted with"]);
    }

    //Get post data
    public function getDataJson($id)
    {
        $model = Post::find($id);
        return response()->json($model);
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

        // Check if post is liked by the authenticated user
        $model->isLiked = false;
        if (Auth::check()) {
            $like = Like::where('user_id', Auth::user()->id)->where('post_id', $model->id)->first();
            if ($like) {
                $model->isLiked = true;
            }
        }

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

    //Update post AJAX
    public function updateAjax(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $formFields = $request->validate([
            'content' => 'required|min:5|max:255',
            'image_path' => 'image'
        ]);

        $post->content = $formFields['content'];

        //Upload image
        if ($request->has('image_path')) {
            $image = $request->file('image_path');
            $imageName = auth()->user()->name . time() . '.' . $image->extension();
            $image->move(public_path('img/posts/'), $imageName);
            $post->image_path = $imageName;
        }

        $post->save();

        return response()->json(['success' => true]);
    }

    //Delete post
    public function destroy($id)
    {
        $post = Post::find($id);
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

    //Like post
    public function likePost($id, Request $request)
    {
        $user = Auth::user();

        // Check if the user has already liked the post
        $isLiked = Like::where('user_id', $user->id)->where('post_id', $id)->first();

        if ($isLiked) {
            // If already liked, remove the like
            $isLiked->delete();
        } else {
            // If not liked, add a new like
            Like::create([
                'user_id' => $user->id,
                'post_id' => $id
            ]);
        }

        // Get the updated like count
        $likeCount = Like::where('post_id', $id)->count();

        return response()->json(['likeCount' => $likeCount, 'isLiked' => $isLiked ? false : true]);
    }
}
