<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class UtilityController extends Controller
{
    //Show advanced search form
    public function createAdvancedSearch()
    {
        return view('advanced-search');
    }

    //Advanced search
    public function advancedSearch(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);

        $title = $request->input('title');
        $content = $request->input('content');
        $created_at = $request->input('created_at');
        $updated_at = $request->input('updated_at');

        $posts = Post::where('title', 'like', "%$title%")
            ->where('content', 'like', "%$content%")
            ->where('created_at', '>=', $created_at)
            ->where('updated_at', '<=', $updated_at)
            ->get();

        return view('advanced-search', ['posts' => $posts]);
    }
}
