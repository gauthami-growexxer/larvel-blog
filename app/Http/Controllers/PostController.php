<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{ 
    public function index()
    {
        $posts = Post::all();
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $newPost = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => 1
        ]);
        return redirect('blog/' . $newPost->id);
    }

    public function edit(Post $post)
    {
        return view('post.edit', [
        'post' => $post,
        ]); 
    }

    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);
        return redirect('blog/' . $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/blog');
    }
}
?>
