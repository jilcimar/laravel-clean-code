<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    private Post $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    public function index(): Collection
    {
        return $this->model->all();
    }

    public function store(array $request): Post
    {
        $this->model = $this->model->create(array_merge($request, ['user_id' => auth()->user()->id]));

        return $this->model;
    }

    public function update(array $request, Post $post): Post
    {
        $post->update($request);
        return $post;
    }
}
