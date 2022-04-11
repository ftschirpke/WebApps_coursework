<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(40);
        return view('posts.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:60',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048|dimensions:max_width=2000,max_height=2000',
            'public' => 'required|boolean',
            'message' => 'required|string|max:5000'
        ]);
        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->title = $validatedData['title'];
        
        if ($request->hasFile('image')) {
            $imageName = time() . "PostImage." . $request->image->extension(); 
            $request->image->storeAs('public/post_images', $imageName);
            $post->image_name = $imageName;
        }
        
        $post->public = $validatedData['public'];
        $post->message = $validatedData['message'];
        $post->save();

        return redirect()->route('posts.show', $post)
            ->with('flash_msg', 'Post was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (!$post->users_viewed_by->contains(Auth::user())) {
            $post->users_viewed_by()->attach(Auth::id());
        }
        return view('posts.show', ['post'=>$post]);
    }

    public function apiShow(Post $post, $offset = 0) {
        $comments_slice = collect($post->comments)->slice($offset, 5)->values();
        if ($comments_slice->isEmpty()) {
            return false;
        }
        $comments_data = array();
        foreach ($comments_slice as $comment) {
            $created_at = $comment->created_at;
            if (now()->subWeeks(1)->greaterThan($created_at)) {
                $created_at = 'created at ' . $created_at->format('Y-m-d H:m:s');
            } else {
                $created_at = 'created ' .
                    now()->longAbsoluteDiffForHumans($created_at) . ' ago';
            }
            $updated_at = 'not updated';
            if ($comment->created_at != $comment->updated_at) {
                $updated_at = $comment->updated_at;
                if (now()->subWeeks(1)->greaterThan($updated_at)) {
                    $updated_at = 'updated at ' . $updated_at->format('Y-m-d H:m:s');
                } else {
                    $updated_at = 'updated ' .
                        now()->longAbsoluteDiffForHumans($updated_at) . ' ago';
                }
            }
            $comment_descr = array(
                'id' => $comment->id,
                'user_id' => $comment->user->id,
                'message' => $comment->message,
                'accountRoute' => route('accounts.show', ['account' => $comment->user->account]),
                'accountDisplayName' => $comment->user->account->display_name,
                'destroyRoute' => route('comments.destroy', ['comment' => $comment]),
                'created_at' => $created_at,
                'updated_at' => $updated_at
            );
            array_push($comments_data, $comment_descr);
        }
        return response()->json($comments_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        dd($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('flash_msg', 'Post was deleted');
    }
}
