<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Notifications\PostWasCommentedOn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public static function getCommentDescription(Comment $comment) {
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
            'editRoute' => route('comments.edit', ['comment' => $comment]),
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );
        return $comment_descr;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request) {
        $validatedData = $request->validate([
            'message' => 'required|string|max:1000',
            'post_id' => 'required|numeric|exists:App\Models\Post,id',
            'user_id' => 'required|numeric|exists:App\Models\User,id'
        ]);
        $comment = new Comment();
        $comment->user_id = $validatedData['user_id'];
        $comment->post_id = $validatedData['post_id'];
        $comment->message = $validatedData['message'];
        $comment->save();

        $comment->post->user->notify(new PostWasCommentedOn($comment));

        $comment_descr = $this->getCommentDescription($comment);
        return response()->json($comment_descr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'message' => 'required|string|max:1000'
        ]);
        $comment->message = $validatedData['message'];
        $comment->save();

        return redirect()->route('posts.show', $comment->post)
            ->with('flash_msg', 'Comment was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()
            ->with('flash_msg', 'Comment was deleted');
    }
}
