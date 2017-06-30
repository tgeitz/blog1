@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->user->name }}</a> posted:
                        <a href="{{ $thread->path() }}"><h4>{{ $thread->title }}</h4></a>
                    </div>

                    <div class="panel-body">
                        <article>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

        @foreach($thread->replies as $reply)
            @include('threads._reply')
        @endforeach

        @if(auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="POST" action="{{ $thread->path() . '/replies'}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                </div>
            </div>
        @else
            <p>Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
        @endif
    </div>
@endsection