<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\QueryFilters\Active;
use App\QueryFilters\Sort;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class PostController extends Controller
{

    public function index()
    {
        // how to use Pipelines
       /* $posts = app(Pipeline::class)
            ->send(Post::query())
            ->through([
                Active::class,
                Sort::class
            ])
            ->thenReturn()
            ->get();*/
        $posts = Post::allPosts();

        /*$posts = Post::query();

        if (request()->has('active')) {
            $posts->where('active', '=', request('active'));
        }
        if (request()->has('sort')) {
            $posts->orderBy('title', request('sort'));
        }
        $posts = $posts->get();*/

        return view('post.index', compact('posts'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
