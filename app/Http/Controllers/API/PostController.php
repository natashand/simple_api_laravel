<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class PostController extends BaseController
{
    private $postService;

    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->postService->getAllPosts($request);

        return $this->sendResponse($posts->toArray(), 'Posts retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $this->postService->createPost($request);

        return $this->sendResponse($post->toArray(), 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postService->getPost($id);

        return $this->sendResponse($post->toArray(), 'Post retrieved successfully.');
    }
}
