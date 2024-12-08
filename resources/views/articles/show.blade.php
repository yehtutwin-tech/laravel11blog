@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <div class="card-subtitle mb-2 text-muted small">
                {{ $article->created_at->diffForHumans() }}
                <br/>
                Category: <b>{{ $article->category->name }}</b>
            </div>
            <p class="card-text">{{ $article->body }}</p>

            @auth
                <form method="POST" action={{ url('/articles/'.$article->id) }}>
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger" />
                </form>
            @endauth
        </div>
    </div>

    @session('success')
        <div class="alert alert-success">{{ session('success') }}</div>
    @endsession

    @session('error')
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endsession

    <ul class="list-group">
        <li class="list-group-item active">
            <b>Comments ({{ count($article->comments) }})
        </li>
        @foreach ($article->comments as $comment)
            <li class="list-group-item">
                @auth
                    <a
                        class="btn-close float-end"
                        href={{ url('/comments/'.$comment->id.'/delete') }}>
                    </a>
                @endauth

                {{ $comment->content }}

                <div class="small mt-2">
                    By <b>{{ $comment->user->name }}</b>,
                    {{ $comment->created_at->diffForHumans() }}
                </div>
            </li>
        @endforeach
    </ul>

    @guest
        <div class="alert alert-info mt-2">
            Please login to add comment
        </div>
    @endguest

    <form action="{{ url('/comments') }}" method="post">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}" />
        <textarea name="content" class="form-control my-2" placeholder="New Comment"></textarea>
        <button type="submit" class="btn btn-secondary">Add Comment</button>
    </form>
</div>
@endsection
