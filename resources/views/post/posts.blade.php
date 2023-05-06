@extends('Layout')

@section('title')
    All Posts
@endsection

@section('body')
    <div class="container w-50" style="border: 1px solid">
        <h1>All Posts</h1>
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="row g-0">
                    @foreach ($post->image as $img)
                        <img style="width: 150px" src="{{ asset("storage/$img->src") }}" alt="Image">
                    @endforeach

                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-name">{{ $post->user->firstName . ' ' . $post->user['lastName'] }}</h5>
                            <h5 class="card-title">{{ $post['title'] }}</h5>
                            <p class="card-text">{{ $post['content'] }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $post['created_at'] }}</small></p>
                            <h5>Number Of likes</h5>
                            <h6>{{ $post['likeCount'] }}</h6>

                            <form action="{{ route('commentStore', [$post['id']]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <textarea name="comment" id="" cols="40" rows="3">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror
                                <input name="img" type="file">
                                @error('img')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror
                                <button type="submit">Add</button>
                            </form>

                            @foreach ($post->comments as $comment)
                                <div style="border: 1px solid">
                                    <h6>{{ $comment->user->firstName . ' ' . $comment->user->lastName }}</h6>
                                    <h6>{{ $comment->content }}</h6>
                                    @foreach ($comment->image as $img)
                                        <img style="width: 150px" src="{{ asset('storage/' . $img->src) }}"alt="Image">
                                    @endforeach
                                    @if ($comment->user->id == Auth::user()->id)
                                        <form action="{{ route('commentDelete', [$comment->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="background-color: red" type="submit">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach

                            <form action="{{ route('likeIncrease', [$post['id']]) }}" method="post">
                                @csrf
                                <button type="submit">Like</button>
                            </form>

                            <form action="{{ route('likeDecrease', [$post['id']]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Dislike</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    @endsection
</div>
