@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-warning">
            <ol>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif
    <form method="post" action="{{ url('/articles/'.$article->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $article->title }}" />
        </div>
        <div class="mb-2">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ $article->body }}</textarea>
        </div>
        <div class="mb-2">
            <label>Category</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ $category->id == $article->category_id ? 'selected' : ''}}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Tags</label>
            <select name="tags[]" class="form-select" size="5" multiple>
                @foreach ($tags as $tag)
                    <option
                        value="{{ $tag->id }}"
                        {{ in_array($tag->id, $article->tags->pluck('id')->toArray()) ? 'selected' : '' }}
                    >{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" />
            @if ($article->image)
                <img src="{{ Storage::url('articles/'.$article->image) }}" class="img-fluid" alt="{{ $article->title }}" width="100" />
            @else
                <img src="{{ asset('images/noimage.png') }}" class="img-fluid" alt="{{ $article->title }}" width="100" />
            @endif
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
</div>
@endsection
