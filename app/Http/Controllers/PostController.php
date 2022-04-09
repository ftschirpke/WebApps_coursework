<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(40);
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
            'title' => 'required|max:60',
            'image' => 'nullable|image',
            'public' => 'required|boolean',
            'message' => 'required|max:5000'
        ]);
        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->title = $validatedData['title'];
        $post->image = $validatedData['image'];
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
        return view('posts.show', ['post'=>$post]);
    }

    public function apiShow(Post $post, $offset = 0) {
        $comments_slice = collect($post->comments)->slice($offset, 5)->values();
        if ($comments_slice->isEmpty()) {
            return false;
        }
        $comments_data = array();
        foreach ($comments_slice as $comment) {
            $comment_descr = array(
                'message' => $comment->message,
                'accountRoute' => route('accounts.show', ['account' => $comment->user->account]),
                'accountDisplayName' => $comment->user->account->display_name
            );
            array_push($comments_data, $comment_descr);
        }
        return response()->json($comments_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('flash_msg', 'Post was deleted');
    }
}
