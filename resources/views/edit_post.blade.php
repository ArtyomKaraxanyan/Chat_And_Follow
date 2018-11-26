@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ action('PostsController@post_update',$id)}}" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputTitle">Post Title</label>
                                <input type="text" name="title" id="exampleInputTitle" value="{{$post->title}}"/>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputBody">Post Body</label>
                                <textarea class="form-control" name="text" id="exampleInputBody" rows="10" >{{$post->text}}</textarea>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <input type="file" name="avatar" id="avatar">
                            <input type="submit" value="Update" name="submit" class="btn btn-dark ">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




