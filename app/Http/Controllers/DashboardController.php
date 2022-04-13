<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() {
        
        $friends = Auth::user()->friends();
        $friends_posts = Post::whereIn('user_id', $friends->pluck('id'))
            ->where('created_at', '>', now()->subDay())->get();
            
        $public_posts = Post::where('public', '=', true)
            ->where('created_at', '>', now()->subDay())->get();
            
        // dd(Auth::user());
        $new_friends = Auth::user()->users_friend_requests_received_from()
            ->wherePivot('created_at', '>', now()->subDay())
            ->wherePivotIn('sender_user_id', $friends->pluck('id'))->get();
        $new_friend_requests = Auth::user()->users_friend_requests_received_from()
            ->wherePivot('created_at', '>', now()->subDay())->get()
            ->diff($new_friends);

            
        $new_post_comments = [];
        $new_post_views = [];
        foreach (Auth::user()->posts as $post) {
            $new_comments_on_post = $post->comments()
                ->where('created_at', '>', now()->subDay())->count();
            if ($new_comments_on_post > 0) {
                array_push($new_post_comments,
                    ['post' => $post, 'count' => $new_comments_on_post]
                );
            }
            $new_views_on_post = $post->users_viewed_by()
                ->wherePivot('created_at', '>', now()->subDay())->count();
            if ($new_views_on_post > 0) {
                array_push($new_post_views,
                    ['post' => $post, 'count' => $new_views_on_post]
                );
            }
        }

        if ($friends_posts->isEmpty() && $public_posts->isEmpty()
            && $new_friends->isEmpty() && $new_friend_requests->isEmpty()
            && empty($new_post_comments) && empty($new_post_views)) {
            
            $recent_activity = null;
        } else {
            $recent_activity = [
                'friends_posts' => $friends_posts,
                'public_posts' => $public_posts,
                'new_friends' => $new_friends,
                'new_friend_requests' => $new_friend_requests,
                'new_post_comments' => $new_post_comments,
                'new_post_views' => $new_post_views
            ];
        }
        return view('dashboard', ['recent_activity' => $recent_activity]);
        
    }
}
