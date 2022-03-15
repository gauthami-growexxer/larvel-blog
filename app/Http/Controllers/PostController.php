<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    const ADDED_SUCCESS_MSG  = 'Blog Post Added Successfully';
    const UPDATE_SUCCESS_MSG = 'Post Updated Successfully';
    const DELETE_SUCCESS_MSG = 'Post Deleted Successfully';
    const MESSAGE            = 'success';
    const PAGINATION_COUNT   = 10;

    /**
     * Function to view all the blog posts
     * @author Gauthami
     * @return void
     */
    public function index()
    {
        $posts = Post::simplePaginate(self::PAGINATION_COUNT);
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show a particular blog by post id
     * @author Gauthami
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Display create post view
     * @author Gauthami
     * @return void
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store blog post data
     * @author Gauthami
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        $newPost = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => 1
        ]);
        return redirect('blog/' . $newPost->id)->with(self::MESSAGE, self::ADDED_SUCCESS_MSG);
    }

    /**
     * Display edit blog post view
     * @author Gauthami
     * @param Post $post
     * @return void
     */
    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update blog post data
     * @author Gauthami
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);
        return redirect('blog/' . $post->id)->with(self::MESSAGE, self::UPDATE_SUCCESS_MSG);
    }

    /**
     * Delete Blog post
     * @author Gauthami
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/blog')->with(self::MESSAGE, self::DELETE_SUCCESS_MSG);
    }
}
