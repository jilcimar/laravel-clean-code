<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment  = new Comment();
        $comment->body = $validated['body'];
        $comment->post_id = $validated['post_id'];
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return response()->json('Comentário Cadastrado com sucesso');
    }
}
