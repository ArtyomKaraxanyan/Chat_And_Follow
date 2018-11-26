@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <img  src="/uploads/avatars/{{$details->avatar}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;" >
                <h2>{{ $details->name }}</h2>
                <p> Email:  {{ $details->email }}</p>

                    <p> {{$details->follows->count()}} {{ str_plural('follows', $details->follows->count()) }}
                     {{$details->followers->count()}} {{ str_plural('followers', $details->followers->count()) }} </p>


                <tbody>

                    <tr>
                        @if($details->id !=auth()->user()->id)
                        @if (auth()->user()->isFollowing($details->id))
                            <td>
                                <form action="{{route('unfollow', ['id' => $details->id])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-follow-{{ $details->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Unfollow
                                    </button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{route('follow', ['id' => $details->id])}}" method="POST">
                                    {{ csrf_field() }}

                                    <button type="submit" id="follow-user-{{ $details->id }}" class="btn btn-success">
                                        <i class="fa fa-btn fa-user"></i>Follow
                                    </button>
                                </form>
                            </td>
                            @endif
                            @endif
                    </tr>
                </tbody>
                <div class="card ">
             <div class="row">

                 <div style="alignment-baseline: before-edge" class="col-md-10 col-md-offset-7">

                     @foreach( $pages as $posts)
                         @if( ($posts->user_id)==$details->id )


                             <a href="{{action('HomeController@read', $details->id)}}" style="color:black"> <img src="/uploads/avatars/{{$details ->avatar }}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;">
                                 <h5>{{ $details->name }}</h5> </a>

                             <a href="{{action('PostsController@read_posts',$posts->id)}}" style="color: lightslategrey">
                             <h3>{{ $posts->title }}</h3>
                                 <img src="/uploads/posts/{{$posts ->avatar }}" style="width:350px; height:350px;"></a>

                             <p>{{ $posts->created_at  }} </p>
                         @endif

                     @endforeach

            </div>
             </div>
            </div>
        </div>
    </div>
    </div>
@endsection






