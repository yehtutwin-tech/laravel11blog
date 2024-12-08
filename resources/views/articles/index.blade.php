@extends('layouts.app')

@section('content')
<div class="container">

    @session('info')
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endsession

    @auth
        <a href="{{ url('/articles/create') }}" class="btn btn-primary mb-2">
            + New Article
        </a>
    @endauth

    @foreach($articles as $article)
        <div class="card mb-2">
            <div class="row">
                <div class="col-3">
                    @if ($article->image)
                        <img src="{{ Storage::url('articles/'.$article->image) }}" class="img-fluid rounded-start" alt="{{ $article->title }}" />
                    @else
                        <img src="{{ asset('images/noimage.png') }}" class="img-fluid rounded-start" alt="{{ $article->title }}" />
                    @endif
                </div>
                <div class="col-9">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $article->title }}
                            <a
                                href="{{ url('/articles/'.$article->id.'/edit')}}"
                                class="btn btn-warning float-end">
                                Edit
                            </a>
                        </h5>
                        <div class="card-subtitle mb-2 text-muted small">
                            {{ $article->created_at->diffForHumans() }}
                            <br/>
                            (Tags: {{ $article->tags->pluck('name')->implode(', ') }})
                            <br/>
                            Category: <b>{{ $article->category->name }}</b>
                        </div>
                        <p class="card-text">{{ $article->body }}</p>
                        <a href="{{ url('/articles/'.$article->id) }}" class="card-link">
                            More &raquo;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $articles->links() }}
</div>
@endsection
