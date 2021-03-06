@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted:
                    <h3>{{ $thread->title }}</h3>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <hr>

            @foreach($replies as $reply)
                @include('threads.reply')
                <br>
            @endforeach

            {{ $replies->links() }}

            @auth
                <form method="post" action="{{ $thread->path() . '/replies' }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default">Post</button>
                </form>
                @else
                <p class="text-center">
                    Plese <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
                </p>
            @endauth
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    This thread was published {{ $thread->created_at->diffForHumans() }} by
                    <a href="#">{{ $thread->creator->name }}</a> and currently has
                    {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
