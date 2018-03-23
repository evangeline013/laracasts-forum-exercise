@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">

                        <form method="POST" action="/threads" >
                            {{csrf_field()}}

                            <div class="form-group">
                                <lable for="channel_id">Choose a Channel:</lable>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">Choose One...</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}}>
                                            {{$channel->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <lable for="title">Title:</lable>
                                <input type="text" id="title" name="title" class="form-control" value="{{old('title')}}" required >
                            </div>

                            <div class="form-group">
                                <lable for="body">Body:</lable>
                                <textarea name="body" id="body" class="form-control" rows="8" value="{{old('body')}}" required></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>

                            @if(count($errors))
                                <ul class="'alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection