@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">

                            <h6 class="flex">
                                <a href={{route('profile', $thread->creator->name)}}>
                                    {{$thread->creator->name}}
                                </a>
                                posted: {{$thread->title}}
                            </h6>

                            @can('update', $thread)
                                <form action="{{$thread->path()}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}

                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endcan

                        </div>
                    </div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>

                    @foreach ($replies as $reply)
                        @include ('threads.reply')
                    @endforeach
                    {{$replies->links()}}

                    <div class="card-header">
                        @if(auth()->check())
                            <form method="POST" action="{{$thread->path().'/replies'}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Post</button>
                            </form>
                        @else
                            <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to reply.</p>
                        @endif
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{$thread->created_at->diffForHumans()}} by
                            <a href={{route('profile', $thread->creator->name)}}>{{$thread->creator->name}}</a>, and currently has
                            {{$thread->replies_count}} {{str_plural('comment', $thread->replies_count)}}.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection