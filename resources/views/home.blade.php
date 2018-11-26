@extends('layouts.app')

@section('content')
<div class="container">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Posts</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        @foreach($users as $user)

                   @foreach($detals as $posts)
                       <div class="card ">

                           @if($user->id==$posts->user_id)
                                    <a href="{{action('HomeController@read', $user->id)}}" style="color:black"> <img src="/uploads/avatars/{{$user ->avatar }}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;">
                                  <h4>{{ $user->name }}</h4></a>

                                    <a href="{{action('PostsController@read_posts', $posts->id)}}" style="color: lightslategrey"><h1>{{ $posts->title }}</h1>
                                <img src="/uploads/posts/{{$posts ->avatar }}" style="width:350px; height:350px;">
                                    </a>
                                <p><i class="fas fa-clock"></i>{{ $posts->created_at  }} </p>
                               <a href="{{action('PostsController@read_posts', $posts->id)}}">
                               <span>{{$posts->comments->count()}} {{ str_plural('comment', $posts->comments->count()) }}</span></a>
                                  @endif

                       </div>

                   @endforeach
                        @endforeach



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
