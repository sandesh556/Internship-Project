@extends('master')
@section('title', 'View a ticket')
@section('content')
    <div class="container col-md-8 col-md-offset-2 mt-5">
        <div class="card">
            <div class="card-header ">
                <h5 class="float-left">{{ $ticket->title }}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <p> <strong>Status</strong>: {{ $ticket->status ? 'Pending' : 'Answere
d' }}</p>
                <p> {{ $ticket->content }} </p>
                <a href="{{action([\App\Http\Controllers\TicketsController::class,'edit'],$ticket->slug)}}" class="btn btn-info">Edit</a>
                <form method="post"
                      action="{{ action([\App\Http\Controllers\TicketsController::class,'destroy'], $ticket->slug) }}"
                      class="float-left">
                    {!! csrf_field() !!}

                    <div>
                        <button type="submit" class="btn btn-warning">Delete</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
        @foreach($comments as $comment)
            <div class="card mt-3">
                <div class="card-body">
                    {{ $comment->content }}
                </div>
            </div>
        @endforeach
        <div class="card mt-3">
            <form method="post" action="/comments">
                {!! csrf_field() !!}
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <input type="hidden" name="post_id" value="{{ $ticket->id }}">
                <fieldset>
                    <legend class="ml-3">Reply</legend>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <textarea class="form-control" rows="3" id="content" name="content"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
