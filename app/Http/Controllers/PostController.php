<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private function storePostImage($image) {
        $imageName = time() . "PostImage." . $image->extension(); 
        $image->storeAs('public/post_images', $imageName);
        return $imageName;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->where('public', '=', true)->paginate(25);
        return view('posts.index', ['descr'=>'public', 'posts'=>$posts]);
    }

    public function indexFriends() {
        $posts_by_friends = Post::latest()
            ->whereIn('user_id', Auth::user()->friends()->pluck('id'))
            ->paginate(25);
        return view('posts.index', ['descr'=>'my friend\'s', 'posts'=>$posts_by_friends]);
    }
    
    public function indexMy() {
        $my_posts = Auth::user()->posts()->latest()->paginate(25);
        return view('posts.index', ['descr'=>'my', 'posts'=>$my_posts]);
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
            $post->image_name = $this->storePostImage($validatedData['image']);
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
            $comment_descr = CommentController::getCommentDescription($comment);
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:60',
            'image_action' => 'required|string|max:7',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048|dimensions:max_width=2000,max_height=2000',
            'message' => 'required|string|max:5000'
        ]);
        if ($validatedData['image_action'] == 'keep') {
            $post->title = $validatedData['title'];
            $post->message = $validatedData['message'];
        } else if ($validatedData['image_action'] == 'replace') {
            if (!str_starts_with($post->image_name, 'http')) {
                Storage::delete(asset('storage/post_images/' . $post->image_name));
            }
            $post->title = $validatedData['title'];
            $post->image_name = $this->storePostImage($validatedData['image']);
            $post->message = $validatedData['message'];
        } else if ($validatedData['image_action'] == 'delete') {
            if (!str_starts_with($post->image_name, 'http')) {
                Storage::delete(asset('storage/post_images/' . $post->image_name));
            }
            $post->title = $validatedData['title'];
            $post->image_name = null;
            $post->message = $validatedData['message'];
        }
        $post->save();

        return redirect()->route('posts.show', $post)
            ->with('flash_msg', 'Post was updated');
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
