@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$thread->creator->name}} posted:
                        {{$thread->title}}
                    </div>
                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($thread->replies as $reply)
                        @include ('threads.reply')
                    @endforeach
                </div>
            </div>
        </div>

        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">

                            <form method="POST" action="{{$thread->path().'/replies'}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Post</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to reply.</p>
        @endif

    </div>
@endsection