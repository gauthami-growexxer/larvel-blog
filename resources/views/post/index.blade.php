@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="row">
                @include('flash-message')
                <div class="col-8">
                    <h1 class="display-one">Blog</h1>
                </div>
                <div class="col-4">
                    <p>Create new Post</p>
                    <a href="/post/create" class="btn btn-primary btn-sm">Add Post</a>
                </div>
            </div>
            @forelse($posts as $post)
            <ul>
                <li><a href="./blog/{{ $post->id }}">{{ ucfirst($post->title) }}</a></li>
            </ul>
            @empty
            <p class="text-warning">No blog Posts available</p>
            @endforelse
            <div class="d-flex">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection