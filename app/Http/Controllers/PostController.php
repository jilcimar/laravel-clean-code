<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreFormRequest;
use App\Http\Requests\Post\UpdateFormRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

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
    public function store(StoreFormRequest $request)
    {
        $validated = $request->validated();

        Post::create(array_merge($validated, ['user_id' => auth()->user()->id]));

        return response()->json('Post Cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateFormRequest $request, Post $post)
    {
        $validated = $request->validated();

        $post->update($validated);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json('Post deletado com sucesso');
    }
}
