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
    <form method="post" action="{{ url('/articles') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" />
        </div>
        <div class="mb-2">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ old('body') }}</textarea>
        </div>
        <div class="mb-2">
            <label>Category</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Tags</label>
            <select name="tags[]" class="form-select" size="5" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" />
        </div>
        <button class="btn btn-primary" type="submit">Create</button>
    </form>
</div>
@endsection
