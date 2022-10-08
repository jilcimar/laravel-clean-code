<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreFormRequest;
use App\Http\Requests\Post\UpdateFormRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private PostRepository $repository;

    public function __construct()
    {
        $this->repository = new PostRepository();
    }

    public function index(): JsonResponse
    {
        return  response()->json($this->repository->index());
    }

    public function store(StoreFormRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return response()->json($this->repository->store($validated));
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }

    public function update(UpdateFormRequest $request, Post $post): JsonResponse
    {
        $validated = $request->validated();
        return response()->json($this->repository->update($validated, $post));
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json('Post deletado com sucesso');
    }
}
