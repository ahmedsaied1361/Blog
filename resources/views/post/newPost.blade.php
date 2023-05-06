@extends('Layout')

@section('title')
    All Posts
@endsection

@section('body')
    <div class="container w-50" style="border: 1px solid">
        <h1>Add A Post</h1>
        <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="inputEmail5" class="form-label">Title</label>
            <input name="title" value="{{ old('title') }}" type="text" id="inputEmail5" class="form-control"
                aria-labelledby="emailHelpBlock">

            @error('title')
                <div style="color: red">{{ $message }}</div>
            @enderror
            <label for="inputEmail5" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="" cols="40" rows="3">{{ old('content') }}</textarea>
            @error('content')
            <div style="color: red">{{ $message }}</div>
            @enderror
            <input type="file" name="imgs[]" multiple>
            @error('imgs')
            <div style="color: red">{{ $message }}</div>
            @enderror
            <button type="submit">Add</button>
        </form>
    </div>
@endsection
