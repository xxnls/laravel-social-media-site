<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    // Follow user
    public function followUser($id)
    {
        // Check if user is already followed, if so, unfollow, then send response
        $follow = Follow::where('first_user_id', Auth::user()->id)->where('second_user_id', $id)->first();

        if ($follow) {
            $follow->delete();
            return response()->json(['success' => 'Unfollowed user successfully.', 'isFollowing' => false]);
        } else {
            $follow = new Follow();
            $follow->first_user_id = Auth::user()->id;
            $follow->second_user_id = $id;
            $follow->save();
            return response()->json(['success' => 'Followed user successfully.', 'isFollowing' => true]);
        }
    }
}
