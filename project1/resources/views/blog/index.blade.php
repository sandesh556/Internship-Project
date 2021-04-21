@extends('master')
@section('title', 'Blog')
@section('content')
    <div class="container col-md-10 col-md-offset-2">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if ($posts->isEmpty())
            <p> There is no post.</p>
        @else
            @foreach ($posts as $post)
                <div class="card mt-4">
                    <div class="card-header"><a href="{{action([\App\Http\Controllers\BlogController::class,'show'],$post->slug)}}">{{ $post->title }}</a></div>
                    <div class="card-body">
                        {{ mb_substr($post->content,0,500) }}  <!-- to only display 500 characters -->
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
