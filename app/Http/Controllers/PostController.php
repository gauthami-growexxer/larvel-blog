<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{ 
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
}
?>
