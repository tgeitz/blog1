@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Forum Threads
                    </div>
                    <div class="panel-body">
                        <article>
                            <a href="{{ $thread->path() }}"><h4>{{ $thread->title }}</h4></a>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

        @foreach($thread->replies as $reply)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}
                        </div>
                        <div class="panel-body">
                            {{ $reply->body }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection