<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = Post::all();

        return  response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'image' => 'required|string'
        ]);

        $post  = new Post();
        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->image = $validated['image'];
        $post->user_id = auth()->user()->id;
        $post->save();

        return response()->json('Post Cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $post  = DB::table('posts')
            ->where('id', $id)
            ->whereNotNull('deleted_at')
            ->first();

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|max:255',
            'body' => 'sometimes',
            'image' => 'sometimes|string'
        ]);

        $post  = DB::table('posts')
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();

        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->image = $validated['image'];

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $post  = DB::table('posts')
            ->where('id', $id)
            ->whereNotNull('deleted_at')
            ->first();
        $post->delete();

        return response()->json('Post deletado com sucesso');
    }
}
