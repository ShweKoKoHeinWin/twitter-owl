<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(User $user)
    {
        $follows = Follower::where('user_id', $user->id)->where('follower_id', Auth::user()->id)->get();
        if($follows->isNotEmpty()) {
           $this->delete($follows);
           return redirect()->route('profile', $user)->with('alert-success', "Unfollowed {$user->name} Successfully");
        } else {
            $this->createFollow($user->id, Auth::user()->id);
        }
        return redirect()->route('profile', $user)->with('alert-success', "Followed {$user->name} Successfully");
    }

    protected function createFollow($following_id, $follower_id){
        $follow = Follower::create([
            'user_id' => $following_id,
            'follower_id' => $follower_id
        ]);
    }

    protected function delete($follows) {
        foreach($follows as $follow) {
            $follow->delete();
        }
    }
}
