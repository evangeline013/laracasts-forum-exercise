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
                                <lable for="title">Title:</lable>
                                <input type="text" id="title" name="title" class="form-control" >
                            </div>

                            <div class="form-group">
                                <lable for="body">Body:</lable>
                                <textarea name="body" id="body" class="form-control" rows="8"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Publish</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection