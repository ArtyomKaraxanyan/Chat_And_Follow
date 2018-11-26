@extends('layouts.app')

@section('content')


        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                    <h2>{{ Auth::user()->name }}</h2>

                    <form enctype="multipart/form-data" action="/profile" method="POST">
                        <label>Update Profile Image</label>
                        <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="pull-right btn btn-sm btn-primary">
                    </form>
                    <p> Email:  {{ Auth::user()->email }}   </p>


                        <p> {{Auth::user()->follows->count()}} {{ str_plural('follows', Auth::user()->follows->count())}}
                            {{Auth::user()->followers->count()}} {{ str_plural('followers', Auth::user()->followers->count()) }} </p>

                        @if(Auth::user()->password===null)
         <a href="{{action('HomeController@editpass', Auth::user()->id)}}"> {{ Auth::user()->name }} Pleas Enter Hear And Wriat Your Password </a>

@endif
                    <h1> Your Posts</h1>
                    @foreach( $detals as $posts)
                    @if( ($posts->user_id)==Auth::user()->id )

                            <h3>{{ $posts->title }}</h3>
                            <img src="/uploads/posts/{{$posts ->avatar }}" style="width:350px; height:350px;">  <a href="{{action('PostsController@edit', $posts->id)}}"  class="fas fa-edit" style="color: black"></a>

                                                                                         <a href="{{action('PostsController@deletePost', $posts->id)}}"  class="fas fa-trash" style="color: red"></a>
                             <p><i class="fas fa-clock"></i>{{ $posts->created_at  }} </p>

                    @endif

                    @endforeach
                </div>
            </div>
        </div>

@endsection
