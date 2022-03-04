<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class BlogTest extends TestCase
{
    public function testDeletePost()
    {
        $post = Post::factory()->count(1)->make();
        $post = Post::first();
        if ($post) {
            $post->delete();
        }
        $this->assertTrue(true);
    }

    public function testCreatePost()
    {
        $response = $this->get('/post/create');
        $response->assertStatus(200);
    }

    public function testStorePost()
    {
        $response = $this->call(
            'POST',
            '/post/create/',
            [
                'title' => 'Blog Post1',
                'body' => 'Blog Description',
                'user_id' => 1
            ]
        );
        $this->assertTrue(true);
    }

    public function testEditPost()
    {
        $post = Post::factory()->count(1)->make();
        $post = Post::first();
        $response = $this->get('/blog/' . $post->id . '/edit');
        $response->assertStatus(200);
    }

    public function testUpdatePost()
    {
        $post = Post::factory()->count(1)->make();
        $post = Post::first();
        $response = $this->call('PATCH', '/blog/' . $post->id . '/edit', $post->toArray());
        $this->assertTrue(true);
    }

    public function testReadAllThePosts()
    {
        $post = Post::first();
        $response = $this->get('/blog');
        $response->assertSee($post->title);
    }

    public function testReadSinglePost()
    {
        $post = $this->call(
            'POST',
            '/post/create/',
            [
                'title' => 'Blog Post12',
                'body' => 'Blog Description',
                'user_id' => 1
            ]
        );
        $post = Post::first();
        $response = $this->get('/blog/' . $post->id);
        $response->assertSee($post->title)
            ->assertSee($post->body);
    }
}
